<?php $indexc = 0;  $timeArr = array();  $year = $_GET['year'];  $return = $this->_sqldata("select * from ppx_content_1 where catid=12 order by updatetime desc"); extract($return); $count=count($result); if (is_array($result)) { foreach ($result as $key=>$t) {  $timeYear = date("Y", $t['updatetime']);  if (!array_key_exists($timeYear, $timeArr)) {  $timeArr[$timeYear] = array();  if (!$year) {  $year = $timeYear;  }  }  array_push($timeArr[$timeYear], $t['id']);  } }  include $this->_include('header'); ?>
<style>
    .news-list-area {
        background: #fff;
        padding: 20px;
    }
    .swiper-container img {
		width: 100%;
        display: block;
        height: 140px;
	}
    .swiper-years {
        background: #a2824F;
        padding: 0 25px;
        box-sizing: border-box;
        position: relative;
    }
    .swiper-years a{
        display: block;
        text-align: center;
        color: #fff;
        text-decoration: none;
        padding: 10px;
    }
    .swiper-years a.active{
        text-decoration: underline;
    }
    .swiper-years .n-btn {
        background: transparent;
        border: 0;
        position: absolute;
        right: 0;
        top: 0;
        z-index: 1;
        height: 100%;
        padding: 0 6px;
    }
    .swiper-years .n-btn img{
        height: 21px;
        width: inherit;
    }
    .swiper-years .p-btn {
        background: transparent;
        border: 0;
        position: absolute;
        left: 0;
        top: 0;
        z-index: 1;
        height: 100%;
        padding: 0 6px;
    }
    .swiper-years .p-btn img{
        height: 21px;
        width: inherit;
    }
    .news-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .news-list li{
        padding-top: 26px;
        padding-bottom: 10px;
        border-bottom: 1px dashed #a2824F;
    }
    .news-list li a{
        display: block;
        position: relative;
        padding-left: 95px;
    }
    .news-list li a img{
        width: 82px;
        height: 52px;
        position: absolute;
        top: 0;
        left: 3px;
    }
    .news-list li a h2{
        color: #a2824F;
        font-size: 15px;
        margin: 0;
        width: 100%;
        overflow: hidden;
        text-overflow:ellipsis;
        white-space: nowrap;
        height: 18px;
        line-height: 18px;
    }
    .news-list li a p{
        color: #000;
        font-size: 13px;
        margin: 0;
        margin-top: 5px;
        width: 100%;
        height: 31px;
        overflow: hidden;
        line-height: 15.5px;
    }
    #deals-page {
        padding-top: 30px;
        padding-bottom: 30px;
        text-align: center;
    }
    #deals-page a {
        color: #a2824F;
        font-size: 15px;
        padding: 10px;
        margin: -10px;
    }
    #deals-page p{
        color: #a2824F;
        display: inline-block;
        margin: 0;
    }
    #deals-page .per-btn {
       float: left;
    }
    #deals-page .next-btn {
       float: right;
    }
</style>
<link rel="stylesheet" href="<?php echo SITE_THEME; ?>css/swiper-3.4.2.min.css">
<script src="<?php echo SITE_THEME; ?>js/swiper-3.4.2.min.js"></script>
<div class="swiper-container" id="swiperNews">
    <div class="swiper-wrapper">
        <?php $return = $this->_listdata("catid=53 more=1 cache=36000 order=listorder_asc"); extract($return); $count=count($result); if (is_array($result)) { foreach ($result as $key=>$t) { ?>
        <div class="swiper-slide">
            <a href="<?php echo $t['tiaozhuanlianjie']; ?>">
                <img src="<?php echo $t['zhanshitupian']; ?>">
            </a>
        </div>
        <?php } } ?>
    </div>
</div>
<div class="news-list-area">
    <div class="swiper-years">
        <div class="swiper-container" id="swiperYears">
            <div class="swiper-wrapper">
                <?php $i = 0;  if (is_array($timeArr)) { $count=count($timeArr);foreach ($timeArr as $k=>$v) { ?>
                <div class="swiper-slide">
                    <a <?php if ($k == $year) { ?>class="active"<?php } ?> href="/index.php?c=content&a=list&catid=12&year=<?php echo $k; ?>">
                        <?php echo $k; ?>
                    </a>
                </div>
                <?php $i = $i + 1;  } } ?>
            </div>
        </div>
        <button class="p-btn"><img src="<?php echo SITE_THEME; ?>images/zjt.png" ></button>
        <button class="n-btn"><img src="<?php echo SITE_THEME; ?>images/y-jt.png" ></button>
    </div>
    <ul class="news-list">
        <?php $yearArr = join(',', array_filter($timeArr[$year]));  $return = $this->_listdata("catid=12 and INid=$yearArr more=1 page=$page pagesize=10 order=updatetime"); extract($return); $count=count($result); if (is_array($result)) { foreach ($result as $key=>$t) { ?>
        <li>
            <a href="<?php echo $t[url]; ?>">
                <img src="<?php echo $t['yulantu']; ?>" alt="">
                <h2><?php echo $t['title']; ?></h2>
                <p><?php echo $t['description']; ?></p>
            </a>
        </li>
        <?php } } ?>
    </ul>
    <div id="deals-page" class="">
    <?php
        if (preg_match("/\"current\">([0-9]+)<\/a>/Ui",$pagelist, $m)) {
            $page = $m[1];
        } else {
            $page = '';
        }
        if (preg_match("/<a href=\"\/index.php\?c=content&a=list&catid=12&page=([0-9]+)&year=[0-9]*\">最末页<\/a>/Ui",$pagelist, $m)) {
            $maxPageNum = $m[1];
        } else {
            $maxPageNum = '';
        }
        if (preg_match("/<a href=\"([^\"|^<]+)\">上一页<\/a>/Ui",$pagelist, $m)) {
            $per_url = $m[1];
        } else {
            $per_url = "";
        }
        if (preg_match("/<a href=\"([^\"|^<]+)\">下一页<\/a>/Ui",$pagelist, $m)) {
            $next_url = $m[1];
        } else {
            $next_url = "";
        }
    ?>
        <a class="per-btn" href="<?php echo $per_url; ?>">上一页</a>
        <p>
            <?php echo $page; ?> / <?php echo $maxPageNum; ?>
        </p>
        <a class="next-btn" href="<?php echo $next_url; ?>">下一页</a>
        <div style="clear:both"></div>
    </div>
</div>
<script>
    new Swiper('#swiperNews', {
		autoplay: 3000,//可选选项，自动滑动
		loop : true,
		autoplayDisableOnInteraction: false
	})
    var mySwiper = new Swiper('#swiperYears', {
        slidesPerView: 4
	})
    $(".swiper-years .p-btn").on("click", function() {
        mySwiper.slidePrev();
    });
    $(".swiper-years .n-btn").on("click", function() {
        mySwiper.slideNext();
    });
</script>
<?php $mbx = array('白茶资讯');  include $this->_include('footer'); ?>