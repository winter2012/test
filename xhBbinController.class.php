<?php
namespace Cll\Controller;
use Think\Controller;
class BbinController extends Controller {
	//默认操作///
    protected function _initialize(){
		$this->p = new \Libr\Platform\Platform();
		$this->p->p = "BBIN";
	}

    ///每2分钟一次，获取当前10分钟内的BBIN投注记录//
    ///体育 */2 * * * * curl http://cll.ctou.com/Bbin/getGameData/gameKind/1/subGameKind/0
    ///视讯 */2 * * * * curl http://cll.ctou.com/Bbin/getGameData/gameKind/3/subGameKind/0
    ///电子 */2 * * * * curl http://cll.ctou.com/Bbin/getGameData/gameKind/5/subGameKind/1
    ///电子 */2 * * * * curl http://cll.ctou.com/Bbin/getGameData/gameKind/5/subGameKind/2
    ///电子 */2 * * * * curl http://cll.ctou.com/Bbin/getGameData/gameKind/5/subGameKind/3
    ///电子 */2 * * * * curl http://cll.ctou.com/Bbin/getGameData/gameKind/5/subGameKind/5
    public function getGameData($gameKind,$subGameKind,$Page = 1){
        $MemberGameData = M("MemberGameData");
        $time = time() - 12*3600;
//        $time = strtotime("2017-10-16 23:59:59") - 12*3600;
        $params = [
            "rounddate"     => date("Y-m-d",$time),
            "starttime"     => date("H:i:s",$time - 60*10),
            "endtime"       => date("H:i:s",$time),
            "gamekind"      => $gameKind,
            "subgamekind"   => $subGameKind == 0 ? "" : $subGameKind,
            "page"          => $Page
        ];
        $Result = $this->p->otherAPI('playerBetLog',$params);
//        $log = new \Think\Log();
//        $log->record('BBIN拉取游戏记录:'.json_encode($Result));
        $TotalCount = intval($Result['pagination']['TotalNumber']);
        if($TotalCount>0){
            $Data = $Result['data'];
            foreach($Data as $k=>$v){
                $res = array();
                $res['username'] = substr($v['UserName'],4);
                $res['plat'] = "BBIN";
                $res['game'] = $v['GameType'];
                $res['bet'] = $v['BetAmount'];
                $res['win'] = $v['Payoff'];//输赢，会员赢钱则为正，会员输钱则为负，总金额 - 下注金额 = 总派彩
                $res['platform_type'] = 1;
                $res['unique_id'] = $v['WagersID'];
                $res['initial_time'] = strtotime($v['WagersDate']);
                $res['time'] = strtotime($v['WagersDate']) + 12*3600;
                $has = $MemberGameData->where(array('unique_id'=>strval($res['unique_id'])))->find();
                if(!$has){
                    $datas[] = $res;
                }
            }
            if(!empty($datas)) {
                $MemberGameData->addAll($datas);
                $TotalDatas = count($datas);
            }
        }
        if(intval($Result['pagination']['TotalPage']) > intval($Result['pagination']['Page'])){
            self::getGameData($gameKind,$Page+1);
        }
        echo $TotalDatas;exit;
    }

	//每5分钟一次，获取最近10分钟PT投注记录,PT数据有15分钟延迟///
	public function getGameDataLog($Page=0){
		$MemberGameData = M("MemberGameData");
		$body = [
            'roundDate'     => date("Y-m-d"),
            'startTime'     => date('H:i:s',time()-600),
            'endTime'       => date('H:i:s'),
//            'roundDate'     => "2017-05-02",
//            'startTime'     => "00:00:00",
//            'endTime'       => "23:59:59",
            'gameKind'      => 3, //1:BB體育 3:視訊 5:機率 12:彩票 15:3D廳
            'subGameKind'   => 1,
            'gameType'      => '',
            'pageIndex'     => $Page
        ];
        $Result = $this->p->otherAPI('playerBetLog',$body);
		$TotalCount = count($Result);
		if($TotalCount){
			foreach ($Result as $v){
				$v = (array)$v;
				$res = array();
				$res['username'] = substr($v['UserName'], 2);//真实账户截取"ct"2位前缀
				$res['plat'] = 'BBIN';
				$res['game'] = $this->BBINGameType[$v['GameType']];
				$res['bet'] = $v['BetAmount'];
				$res['win'] = $v['Payoff'];
				$res['unique_id'] = strval($v['SerialID']);
				$res['platform_type'] = $this->getPlatFormType($v['GameType']);
                $res['initial_time'] = strtotime($v['WagersDate']);
				$res['time'] = strtotime($v['WagersDate']);
				$has = $MemberGameData->where(array('unique_id'=>strval($res['unique_id'])))->find();
				if(!$has)	$datas[] = $res;
			}
			if(!empty($datas)) {
				$MemberGameData->addAll($datas);
			}
		}

		if($TotalCount>(5000*($Page+1))){
			self::getGameDataLog($Page+1);
		}
		echo $TotalCount;exit;
	}








	//每2分钟一次，获取最近30分钟PT投注记录,PT数据有15分钟延迟///
	public function getGameDataLogYesterday($hour=0,$Page=0){
		set_time_limit(0);
		$Time = strtotime(date('Y-m-d',strtotime('-1 day')));
		$From = date('c',$Time+$hour*3600);
		$To = date('c',$Time+($hour+1)*3600);

		if($hour > 23) {
			$From = date('c',$Time);
			$To = date('c',$Time+86400);
		}

		$MemberGameData = M("MemberGameData");
		$body = array(
			'From' => $From,
			'To' => $To,
			'Page'=> $Page,
			'RecordsPerPage'=> 5000,
		);
		$List = $this->p->otherAPI('playerBetLog',$body);
		//dump($List);exit;
		$Result = (array)$List['Body']->Result ;
		$TotalCount = $List['Body']->Pagination->TotalCount;
		$map = array(
			'time'=>array(array('egt',strtotime($From)),array('lt',strtotime($To))),
			'plat'=>'PT',
		);
		$our_count = $MemberGameData->where($map)->count();
		echo 'PT端游戏记录数：',$TotalCount,'<br>我们这边的游戏记录数：',$our_count,'<br>';
		if($hour > 23) {
			exit;
		}
		if($TotalCount!=$our_count){
			if($Result){
				foreach ($Result as $v){
					$v = (array)$v;
					$res = array();
					$res['username'] = $v['PlayerName'];
					$res['plat'] = 'PT';
					$res['game'] = $v['GameName'];
					$res['bet'] = $v['Bet'];
					$res['win'] = $v['Win'];
					$res['unique_id'] = $v['GameCode'];
                    $res['initial_time'] = strtotime($v['GameDate']);
					$res['time'] = strtotime($v['GameDate']);
					$has = $MemberGameData->where(array('unique_id'=>strval($res['unique_id'])))->find();
					if(!$has){
						$datas[] = $res;
					}
				}
				$MemberGameData->addAll($datas);
			}

			if($TotalCount>(5000*($Page+1))){
				echo $TotalCount,'-page',$Page,'<br>';
				self::getGameDataLog($hour,$Page+1);
			}
		}
		echo $TotalCount;exit;
	}

	//统计昨天一天的PT会员投注输赢报表///
	public function playerWinLossReport(){
		$dateTime 		= strtotime(date('Y-m-d',strtotime('-1 day')));
		$dateTime_to	= strtotime(date('Y-m-d'));
		$map = array(
			'time'=>array(array('egt',$dateTime),array('lt',$dateTime_to)),
			'_string'=>"plat = 'PT'",
		);
		$MemberGameData = M("MemberGameData");
		$data = $MemberGameData->where($map)->field('username as username,sum(win) as egame_win,sum(bet) as egame_bet,count(id) as egame_bet_times')->group('username')->select();
		if($data){
			$Statistics = M('MemberStatistics');
			foreach($data as $v) {
				if($v['username']){
					$v['uid'] = M('MemberPlatform')->getFieldByValue($v['username'],'uid');
					$rid = M('Member')->getFieldByUsername($v['username'],'level');
					$Role = M('MemberRoleSet')->where(array('rid'=>$rid,'name'=>'EgameRatio'))->find();

					if($v['uid']){
						$v['time'] = $dateTime;
						$map = array('uid'=>$v['uid'],'time'=>$dateTime);
						$has = $Statistics->field('id')->where($map)->find();
						if($has['id']){
							$datas = array(
								'id'=>$has['id'],
								'egame_win'=>$v['egame_win'],
								'egame_bet'=>$v['egame_bet'],
								'egame_bet_times'=>$v['egame_bet_times'],
								'egame_ratio'=>$Role['value'],

							);
							$Statistics->save($datas);
						}else{
							$add = array(
								'uid'=>$v['uid'],
								'year'=>date('Y',$dateTime),
								'month'=>date('m',$dateTime),
								'time'=>$dateTime,
								'egame_win'=>$v['egame_win'],
								'egame_bet'=>$v['egame_bet'],
								'egame_bet_times'=>$v['egame_bet_times'],
								'egame_ratio'=>$Role['value'],
							);
							$Statistics->add($add);
						}
						
					}
				}
			}
		}
		echo count($data);exit;
	}

	public function getPlatFormType($data){
	    $pre = substr($data,0,2);
	    if($pre == "30"){
            return 0;
        } else if($pre == "50") {
	        return 1;
        } else if($pre == "150") {
            return 2;
        } else {
	        return 4;
        }
    }

	public $BBINGameType = [
        '3001' => '百家樂',
        '3002' => '二八槓',
        '3003' => '龍虎鬥',
        '3005' => '三公',
        '3006' => '溫州牌九',
        '3007' => '輪盤',
        '3008' => '骰寶',
        '3010' => '德州撲克',
        '3011' => '色碟',
        '3012' => '牛牛',
        '3013' => '賽本引',
        '3014' => '無限21點',
        '3015' => '番攤'
    ];
	
}

