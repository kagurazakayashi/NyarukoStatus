<?php if (!isset($_GET["inpage"])) {
    echo '<html lang="zh-CN">';
    echo '<head><meta charset="UTF-8"><title>雅诗服务器状态</title><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="author" content="cxchope"><meta name="copyright" content="Copyright KagurazakaYashi, All rights Reserved."><meta name="designer" content="KagurazakaYashi"><meta name="publisher" content="KagurazakaYashi 神楽坂雅詩"><meta name="theme-color" content="#FE99CC"></head><body>';
} ?>
    <style>
    .stattb {
        margin-left:10%;
        margin-right:10%;
        width:80%;
        background-color:#F0F8FF;
        overflow:hidden;
        border-left:1px solid #00CCFF;
        border-bottom:1px solid #00CCFF;
    }
    .stattt {
        width:90%;
        margin-right:10%;
        text-align:right;
    }
    .hostname {
        width:90%;
        margin-left:10%;
        text-align:left;
    }
    .stattbitem {
        width:<?php
        if (isset($_GET["w"]) && intval($_GET["w"]) >= 1 && intval($_GET["w"]) <= 1024) {
            echo $_GET["w"];
        } else {
            echo "10";
        }
        ?>px;
        height:100%;
        float:right;
        bottom:0px;
        border:1px solid #F0F8FF;
        cursor:crosshair;
    }
    .stattbitemi {
        background-color:#F0F8FF;
        width:100%;
    }
    .stattbitemh {
        position:relative;
        background-color:#F0F8FF;
        width:100%;
        height:100%;
        filter:alpha(Opacity=80);
        -moz-opacity:0.5;
        opacity: 0.5;
    }
    .stattbitem_green {
        background-color:#669900;
        background:-webkit-linear-gradient(bottom, #00FF00, #669900);
        background:-moz-linear-gradient(bottom, #00FF00, #669900);
        background:-o-linear-gradient(bottom, #00FF00, #669900);
        background:linear-gradient(bottom, #00FF00, #669900);
    }
    .stattbitem_yellow {
        background-color:#CC9900;
        background:-webkit-linear-gradient(bottom, #FFFF00, #CC9900);
        background:-moz-linear-gradient(bottom, #FFFF00, #CC9900);
        background:-o-linear-gradient(bottom, #FFFF00, #CC9900);
        background:linear-gradient(bottom, #FFFF00, #CC9900);
    }
    .stattbitem_red {
        background-color:#CC0000;
        background:-webkit-linear-gradient(bottom, #FF6666, #CC0000);
        background:-moz-linear-gradient(bottom, #FF6666, #CC0000);
        background:-o-linear-gradient(bottom, #FF6666, #CC0000);
        background:linear-gradient(bottom, #FF6666, #CC0000);
    }
    #tbcontrolbox {
        position:fixed;
        text-align: center;
        width: 10%;
        height: auto;
        left: 0;
        top: 45%;
    }
    #tbcontrolbox button {
        border-left: 1px solid #00CCFF;
        border-right: 1px solid #00CCFF;
        background-color:#F0F8FF;
        width: 32px;
        height: 32px;
        cursor:pointer;
    }
    #tbcontrolboxb2 {
        border-top: none;
        border-bottom: 1px solid #00CCFF;
    }
    #tbcontrolboxb1 {
        border-top: 1px solid #00CCFF;
        border-bottom: none;
    }
    #statfoot {
        width:100%;
        text-align:center;
    }
    </style>
    <center><b>雅詩服务器状态</b></center>
    <script>
    function yashiserverstatus_datainfo(isshow,divid,tableid,spantitle) {
        var ndiv = document.getElementById(divid);
        var ndivt = document.getElementById(tableid+"t");
        if (isshow == 1) {
            ndiv.style.border="1px solid #00CCFF";
        } else if (isshow == 0) {
            ndiv.style.border="1px solid #F0F8FF";
        }
        if (isshow != 0 && ndivt != null) {
            ndivt.innerHTML = spantitle;
        }
    }
    function yashiserverstatus_zoomw(zoomin) {
        var stattbitems = document.getElementsByClassName("stattbitem");
        if (stattbitems && stattbitems.length > 0) {
            var newwidth = parseInt(stattbitems[1].offsetWidth);
            newwidth = newwidth + zoomin - 2;
            if (newwidth >= 1 && newwidth <= 1024) {
                for (nstattbitem in stattbitems)
                {
                    var nitem = document.getElementById(nstattbitem);
                    if (nitem != null) {
                        nitem.style.width = newwidth + "px";
                    }
                }
            }
        }
    }
    </script>
    <?php
    if (!isset($_GET["inpage"])) echo '<p><hr></p>';
    $yashisitestatus = explode("\n", file_get_contents("yashisitestatus.txt"));
    $yashisitestatus = array_reverse($yashisitestatus);
    $data = array();
    $dataname = array();
    for($i=0; $i<count($yashisitestatus); $i++) {
        $nowinfo = explode('|',$yashisitestatus[$i]);
        if (isset($nowinfo[1])){
            if (isset($data[$nowinfo[1]])) {
                $nowdata = $data[$nowinfo[1]];
                $nowdata[count($nowdata)] = [$nowinfo[0],$nowinfo[3],$nowinfo[4]];
                $data[$nowinfo[1]] = $nowdata;
                $dataname[$nowinfo[1]] = $nowinfo[2];
            } else if (isset($nowinfo[4])){
                $nowdata = [[$nowinfo[0],$nowinfo[3],$nowinfo[4]]];
                $data[$nowinfo[1]] = $nowdata;
                $dataname[$nowinfo[1]] = $nowinfo[2];
            }
        }
    }
    $tableheight = 320;
    $zoom=500;
    while(list($key,$val)= each($data)) {
        if ($key == "") {
            break;
        }
        $tableid="stattb_".$key;
        echo '<div class="hostname"><h2>'.$dataname[$key].'</h2></div><div id="'.$tableid.'" class="stattb" style="height:'.$tableheight.'px;">';
        $showcount = count($val);
        if (isset($_GET["c"]) && intval($_GET["c"]) <= 10000 && intval($_GET["c"]) >= 0 && $showcount <= count($val)) {
            $showcount = intval($_GET["c"]);
        }
        for($i = 0; $i < $showcount; $i++) {
            $nowinfoarr = $val[$i];
            $itime = $nowinfoarr[0];
            $iping = floatval($nowinfoarr[1]);
            $iok = $nowinfoarr[2];
            $spanclass = "stattbitem_green";
            $ioks = "正常服务";
            if ($iok != "OK") {
                $ioks = "服务中断";
                $spanclass = "stattbitem_red";
            } else if ($iping >= 0.5) {
                $ioks = "负载较高";
                $spanclass = "stattbitem_yellow";
            }
            if (isset($_GET["h"]) && intval($_GET["h"]) <= 10000 && intval($_GET["h"]) >= 1) {
                $zoom = intval($_GET["h"]);
            }
            $itemheight = $tableheight-$iping*$zoom;
            if (($tableheight - $itemheight > $tableheight) || ($iok != "OK" && $iping == "0")) {
                $itemheight = 0;
            }
            $spantitle = "检测时间：".$itime."，响应时间：".$iping."s，".$ioks;
            $spanid = $key.$itime;
            $mjsc = "'".$spanid."','".$tableid."','".$spantitle."'";
            echo '<span class="stattbitem '.$spanclass.'" id="'.$spanid.'" title="'.$spantitle.'" onmouseover="yashiserverstatus_datainfo(1,'.$mjsc.');" onmouseout="yashiserverstatus_datainfo(0,'.$mjsc.');" onclick="yashiserverstatus_datainfo(2,'.$mjsc.');"><div class="stattbitemi" id="'.$spanid.'i" style="height:'.$itemheight.'px"></div></span>';
        }
        echo '</div><div id="'.$tableid.'t" class="stattt">&nbsp</div>';
    }
    if (!isset($_GET["inpage"])) echo '<p><hr></p>';
    ?>
    <div id="tbcontrolbox">
    <button id="tbcontrolboxb1" type="button" onclick="yashiserverstatus_zoomw(1);">＋</button><br>
    <button id="tbcontrolboxb2" type="button" onclick="yashiserverstatus_zoomw(-1);">－</button>
    </div>
    <div id="statfoot"><p><a href="https://github.com/kagurazakayashi/NyarukoStatus" target="_blank">NyarukoStatus</a> © 神楽坂雅詩 2017</p></div>
    <?php if (!isset($_GET["inpage"])) {
        echo "</body></html>";
    } ?>