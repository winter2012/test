<?php
namespace Cll\Controller;
use Think\Controller;
class BBINController extends Controller {
    protected function _initialize(){
		$this->p = new \Libr\Platform\Platform();
		$this->p->p = "BBIN";
	}

	///每5分钟一次，获取当前15分钟内的BBIN投注记录//
    ///体育 */5 * * * * curl http://cll.xh.com/BBIN/getGameData/gameKind/1
    ///视讯 */5 * * * * curl http://cll.xh.com/BBIN/getGameData/gameKind/3
	public function getGameData($gameKind,$Page = 1){
		$MemberGameData = M("MemberGameData");
        $params = [
            "rounddate" => date("Y-m-d"),
            "starttime" => date("H:i:s",time()-60*15),
            "endtime"   => date("H:i:s"),
            "gamekind"  => $gameKind,
            "page"      => $Page
        ];
		$Result = $this->p->otherAPI('playerBetLog',$params);
//        $log = new \Think\Log();
//        $log->record('BBIN拉取游戏记录:'.json_encode($Result));
		$TotalCount = intval($Result['pagination']['TotalNumber']);
		if($TotalCount>0){
			$Data = $Result['data'];
			foreach($Data as $k=>$v){
				$res = array();
				$res['username'] = $v['UserName'];
				$res['plat'] = "BBIN";
				$res['game'] = $v['LeagueName'];
				$res['bet'] = $v['Commissionable'];
				$res['win'] = $v['Payoff'] - $v['Commissionable'];
				$res['platform_type'] = 0;
				$res['unique_id'] = $v['WagersID'];
				$res['time'] = strtotime($v['WagersDate']);
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

}
