<?php
/**
 * Created by Chison.
 * User: Chison
 * Date: 2016-11-3
 * Time: 10:24
 */
error_reporting(0);
if(isset($_POST['url']))
{
    //前置过滤
    if(!filter_var($_POST['url'],FILTER_VALIDATE_URL)){
        echo json_encode(array('msg'=>1));exit();
    }

    if(!filter_var($_POST['page'],FILTER_VALIDATE_INT) && !filter_var($_POST['url'],FILTER_VALIDATE_FLOAT)){
        echo json_encode(array('msg'=>1));exit();
    }
    $arr = $_POST;
    $arr['msg'] = 2;
    echo json_encode($arr);exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HTML2PDF | HTML-A4 print online</title>
    <meta name="description" content="在线打印网页应用，作者：Chison" />
    <meta name="keywords" content="HTMLPRINT、网页转化为PDF、在线打印网页、HTMLTOPDF、HTML2PDF">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="home-template" style="padding-top:50px;padding-bottom:20px;overflow:scroll;overflow-x:hidden">
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
            <a class="navbar-brand hidden-sm" href="/" >HTML2PDF | HTML-A4打印</a>
        </div>

        <div class="navbar-collapse collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:void(0);" id="login_now" onclick="window.print();"><i class="glyphicon glyphicon-print"></i></a></li>
            </ul>
            <form class="navbar-form navbar-right" role="form" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="请输入打印的网址" name="url" baiduSug="1">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="指定打印的页数" name="page" baiduSug="1">
                </div>
            </form>
        </div>
    </div>
</div>
<div id="YOUDAO_SELECTOR_WRAPPER" style="display:none; margin:0; border:0; padding:0; width:320px; height:240px;"></div>
<div class="text-center" id="userSay">
    <h3>轻松三步将HTML页面转化为PDF</h3>
    <p>1、输入想要打印的网址 （如：http://shexiangsheng.cn）</p>
    <p>2、输入需要打印的页数 (如：1，1.4，2等)</p>
    <p>3、点击打印图标进入打印设置。 </p>

</div>
<iframe src="<?php echo $url;?>" id="iframe" frameborder="0" scrolling="no"></iframe>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript">
$(function () {
    $('#iframe').width(document.body.clientWidth);

    $("input").bind('propertychange input', function () {
        var data = {'url':$('input[name=url]').val(),'page':$('input[name=page]').val()};
        console.log(data);
        $.ajax({
            type : 'POST',
            url : '/index.php',
            data :  data,
            success : function (response, status, xhr) {
                var obj =  eval("(" + response + ")");
                if(obj.msg == 2)
                {
                    $('#iframe').attr('src',obj.url);
                    $('#iframe').height(document.body.clientWidth*29.7/21*obj.page);
                    $('#userSay').css('display','none');
                }
            }, error : function (xhr, errorText, errorStatus) {
                console.log('请求失败');
            }
        });
    });
});
</script>
</body>
</html>
