<?php
$act=isset($_GET['act'])?$_GET['act']:null;
if($act=="chadan"){
	$username=$_POST['username'];
	$data=array(
	   'username'=>$username
	);
    $result=get_url("http://124.221.250.128:88/api.php?act=chadan",$data);
	exit($result);
	
}elseif($act=='budan'){
	$id=$_POST['id'];
	$data=array(
	   'id'=>$id
	);
    $result=get_url("http://124.221.250.128:88/api.php?act=budan",$data);
	exit($result);	
}

	
	
	
function get_url($url,$post=false,$cookie=false,$header=false){//curl
    $ch = curl_init();
    if($header){
        //curl_setopt($ch,CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }else{
        curl_setopt($ch,CURLOPT_HEADER, 0);
    }
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.62 Safari/537.36');//设置UA 否则会被拦截
    if($post){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
    }
    if($cookie){
        curl_setopt($ch, CURLOPT_COOKIE,$cookie);
    }
    
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}	
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <title>网课售后系统</title>
        <link href="assets/imgage/favicon.ico" rel="shortcut icon"/>
        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/index.css" rel="stylesheet"/>
        <link rel="icon" href="../user/ayjs/aystylejs/favicon.ico" type="image/ico">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets
            	
            	
            	
            	/js/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            .cm-kfqy{
          background-color: #fff;
          padding: 1px 3px;
          padding-left: 10px;
          display: block;
          color: #000 !important;
          border-radius: 4px;
        }
        .cm-kfqy:hover{
          background-color: #f0f0f0;
          padding: 1px 3px;
          padding-left: 10px;
          width: 100%;
          display: block;
          color: #000 !important;
          border-radius: 4px;
        }
        </style>
    </head>
    <body id="page-top">
        <div id="app">
            <div class="col-lg-4 col-md-7 col-sm-10" style="float: none;  margin: auto; padding-top: 50px">
                <!--html公告代码 开始-->                                                         
                <!--html公告代码 结束-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{title}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    {{inputName}}
                                </div>
                                <input class="form-control" type="text" v-model="username"/>
                            </div>
                        </div>
                        <div class="btn-group btn-group-justified form-group">
                            <a class="btn btn-block btn-default" v-bind:html="btnName" v-on:click="query()">
                                {{btnName}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" v-show="userInfo.show">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{userInfo.title}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>学生姓名</th>
                                    <th>学习账号</th>
                                    <th>学校名称</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{userInfo.name}}
                                    </td>
                                    <td>
                                        {{userInfo.user}}
                                    </td>
                                    <td>
                                        {{userInfo.school}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default" v-show="orderInfo.show">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{orderInfo.title}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" v-for="(item,index) in orderInfo.list" v-bind:key="index">
                                <a class="cm-kfqy collapsed" data-parent="#accordion" data-toggle="collapse" :href="'#collapseOne'+index">
                                        <h5>[课程]<b>{{item.kcname}}</b></h5>
                                </a>
                                <div class="panel-collapse collapse in" :id="'collapseOne'+index">
                                    <div class="panel-body"> 
                                    	       <span><b>平台名字：</b>{{item.ptname}}<br/></span>
		                                     <!--  <span><b>课程名称：</b>{{item.kcname}}<br/></span>-->
			                                   <span>     <b>下单时间：</b>{{item.addtime}} <br/></span>
			                                    <span v-if="item.courseStartTime!=''"><b>课程开始时间：</b>{{item.courseStartTime}}<br/></span>
			                                    <span v-if="item.courseEndTime!=''">    <b>课程结束时间：</b>{{item.courseEndTime}}<br/></span>
			                                     <span v-if="item.examStartTime!=''">   <b>考试开始时间：</b>{{item.examStartTime}}<br/></span>
			                                    <span v-if="item.examEndTime!=''">    <b>考试结束时间：</b>{{item.examEndTime}}<br/></span>
	                                    <span><b>订单状态：</b>
								                <el-tag size="mini" v-if="item.status=='待处理'"><i class="el-icon-position"></i>{{item.status}}</el-tag>
							            		<el-tag size="mini" type="success" v-else-if="item.status=='已完成'"><i class="el-icon-trophy"></i>{{item.status}}</el-tag>
							            		<el-tag size="mini" type="danger" v-else-if="item.status=='异常'"><i class="el-icon-warning-outline"></i>{{item.status}}</el-tag>
							            		<el-tag size="mini" type="warning" v-else-if="item.status=='进行中'"><i class="el-icon-stopwatch"></i>{{item.status}}</el-tag>
							            		<el-tag size="mini" type="warning" v-else-if="item.status=='积分中'"><i class="el-icon-stopwatch"></i>{{item.status}}</el-tag>
							            		<el-tag size="mini" type="info" v-else-if="item.status=='已退单'"><i class="el-icon-circle-check"></i>{{item.status}}</el-tag>
							            		<el-tag size="mini" type="warning" v-else-if="item.status=='重刷中'"><i class="el-icon-stopwatch"></i>{{item.status}}</el-tag>
							            		<el-tag size="mini" type="info"v-else-if="item.status=='已取消'"><i class="el-icon-circle-check"></i>{{item.status}}</el-tag>
							            		<el-tag v-else type="warning" size="mini">{{item.status}}</el-tag>
			                                    	<br/></span>			                                  
			                                     <span>   <b>课程进度：</b>{{item.process}}<br/></span>
			                                    <span>    <b>备注：</b>{{item.remarks}}<br/></span>            
                                        <!--<div class="progress">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" class="progress-bar progress-bar-info" role="progressbar" v-bind:style="'width:'+(item.chapterCount/item.unfinishedChapterCount*100)+'%;'">
                                                <span class="sr-only">
                                                    {{item.chapterCount/item.unfinishedChapterCount*100}}% 完成（信息）
                                                </span>
                                            </div>
                                        </div>-->
                                        <span> <b> 是否重刷：</b><el-button v-on:click="fill(item.id)" type="danger" size="mini" plain><i class="el-icon-refresh-right"></i>重刷</el-button></span>     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="assets/js/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script src="assets/js/vue.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- 引入样式 -->
<link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
<!-- 引入组件库 -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>

<script>
	/*本页面查询进度并非实时进度，具体以登录app查询为准！
如挤登后务必需要到本页面操作一下重刷。
下单后如果查不到订单请等待几小时后查询
漏课程请咨询下单网站客服
请勿无脑重刷 提交次数过多并不会有啥翻倍效果
每天下午可能为订单提交高峰期 重刷容易失败 换个时间提交即可
*/
new Vue({
    el: '#app',
    data: {
        title: '网课自助售后查询',
        inputName: '学习账号',
        btnName: '查询信息',
        list: {},
        username: '',
        is_load: false,
        userInfo: {
            show: false,
            title: '学生信息',
            name: '',
            user: '',
            school: '',
            type: 0
        },
        orderInfo: {
            show: false,
            title: '订单信息',
            list: {}
        }
    },
    methods: {
        query: function() {
            //console.log(this.username);
            if (this.username == "") {
            	layer.msg("请输入查询账号！");              
                this.btnName = '重新查询信息';
                return false;
            }
            var that = this;
            that.userInfo.show = false;
            that.orderInfo.show = false;
            that.orderInfo.list = {};
            that.load();
            $.ajax({
                type: "POST",
                url: "?act=chadan",
                data: {username: this.username},
                dataType: 'json',
                success: function(data) {
                    that.load();
                    if (typeof data.data == 'object') {
                        if (data.data.length > 0) that.userInfo.name = data.data[0].name;
                        if (data.data.length > 0) that.userInfo.school = data.data[0].school;
                        that.userInfo.user = that.username;
                        that.userInfo.show = true;
                        if (data.data.length > 0) {
                            that.orderInfo.type = data.type;
                            that.orderInfo.list = data.data;
                            that.orderInfo.show = true;
                        }
                    } else {
                        layer.msg("未查询到相关订单信息！");
                    }
                },
                error: function(e) {
                    console.log(e);
                    layer.alert('服务器错误，请稍后再试！');
                }
            });
        },
        fill: function(id) {
            var wktype = this.orderInfo.type;
            $.ajax({
                type: "POST",
                url: "?act=budan",
                data: {id:id},
                dataType: 'json',
                success: function(data) {
                    if (data.code == 1) {
                        layer.alert(data.msg,{icon:1});
                    } else {
                        layer.alert(data.msg,{icon:2,title:'马保国：'});
                    }
                },
                error: function(e) {
                    console.log(e);
                    layer.alert('服务器错误，请稍后再试！');
                }
            });
        },
        load: function() {
            if (this.is_load === false) {
                this.btnName = '查询中..';
            } else {
                this.btnName = '重新查询信息';
            }
            this.is_load = !this.is_load;
        }
    }
});


	

</script>