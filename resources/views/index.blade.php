@extends('layouts/app')

@section('style')
<style>
    html, body {
        font-weight: 100;
        height: 90vh;
        margin: 0;
    }

    .full-height {
        height: 80vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('index', 'padding-top: 0;')

@section('content')
<!-- banner -->
<section>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item header-carousel-item item-1 bg-cover active">
        <div class="carousel-caption">
            <div class="container">
            <h3>氣質老闆，手工拉線</h3>
            <p>拍線對球友而言非常重要，所以我們堅持手工拉線，相互交錯的球線就像阡陌縱橫的田間小路一般，灌溉著老闆的用心與堅持</p>
            </div>
        </div>
        </div>
        <div class="carousel-item header-carousel-item item-2 bg-cover">
        <div class="carousel-caption">
            <div class="container">
            <h3>認真研究，尋找自己的球拍</h3>
            <p>這裡提供一個舒適的環境讓你可以喝杯咖啡洗滌城市的喧囂，好好研究選出一把屬於你、適合你的球拍或其他運動用品，如果不確定自己適合什麼，也能在店內到處看看，瀏覽運動雜誌，諮詢專業店員和老闆。</p>
            </div>
        </div>
        </div>
        <div class="carousel-item header-carousel-item item-3 bg-cover">
        <div class="carousel-caption">
            <div class="container">
            <h3>咖啡的精選風味</h3>
            <p>老闆對咖啡情有獨鍾，店內皆採用自家烘培咖啡豆，有甜潤回甘帶花果香的招牌「象豆」，也有舒適清爽帶著柑橘味的「肯亞AA」，族繁不及備載，詳見
                <a href="./coffee">咖啡地圖</a>
            </p>
            </div>
        </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</section>
<!-- title -->
<section class="py-5">
    <div class="col-lg-12 mb-3 text-center">
    <h3>24 磅羽球咖啡廳</h3>
    <p style="font-size: 90%;">
        <b>羽球與咖啡的結合，人們說這是靜與動的矛盾衝突
        <br>我卻說這是運動與生活的完美互補</b>
    </p>
    </div>
</section>
<!-- call to action -->
<section class="container-fluid text-secondary">
    <div class="row">
    <div class="col-md-6 p-5 background-muted info-background-one muted-block">
        <div class="w-75 h-100 p-3 mx-auto">
        <div class="mb-3">
            <img class="img-fluid" style="width: 50px" src="./images/coffee-beans-icon.svg" alt="">
        </div>
        <h3>品味生活的態度</h3>
        <p class="mb-0">品嘗最香醇的手沖咖啡，體驗忘卻不了的莓果香，享受舌尖回甘的濃郁滋味</p>
        <button href="./coffee.html" class="btn btn-outline-theme-secondary  my-3">產品詳情</button>
        <blockquote class="blockquote">
            <p class="mb-0">如果我不在家，就是在咖啡館；
            <br>如果不是在咖啡館，就是在往咖啡館的路上</p>
            <footer class="blockquote-footer text-secondary">奧地利作家
            <cite title="Source Title">Peter Altenberg</cite>
            </footer>
        </blockquote>
        </div>
    </div>
    <div class="col-md-6 p-5 background-muted info-background-two muted-block">
        <div class="w-75 h-100 p-3 mx-auto">
        <div class="mb-3">
            <img class="img-fluid" style="width: 50px" src="./images/badminton-icon.svg" alt="">
        </div>
        <h3>激起心中的漣漪</h3>
        <p class="mb-0">了解羽球界的最新時事，補充最精良的裝備，體驗廝殺球場上的快感，讓腎上腺素肆意流動</p>
        <button href="./coffee.html" class="btn btn-outline-theme-secondary my-3">產品詳情</button>
        <blockquote class="blockquote">
            <p class="mb-0">當我覺得勝券在握的時候，其實比賽才剛開始。</p>
            <footer class="blockquote-footer text-secondary">羽球選手
            <cite title="Source Title">Lin Dan</cite>
            </cite>
            </footer>
        </blockquote>
        <!-- <blockquote class="blockquote">
            <p class="mb-0">我還沒有成功，只是在前往成功的路上。</p>
            <footer class="blockquote-footer">羽球選手 <cite title="Source Title">Lee Chong Wei</span></cite></footer>
        </blockquote>           -->
        </div>
    </div>
    </div>
</section>
<!-- store info -->
<section class="py-5 store-info">
    <div class="container">
    <div class="row">
        <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3615.0500059316632!2d121.51766251500624!3d25.03237698397311!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442a99ea77ece43%3A0x8461936a2855c267!2zMjTno4XlkpbllaHnvr3nkIM!5e0!3m2!1szh-TW!2stw!4v1530440082380" frameborder="0" allowfullscreen ></iframe>
        </div>
        <div class="col-md-6">
        <h3>本店資訊</h3>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <td>位置</td>
                <td>台北市 寧波東街3-1號</td>
            </tr>
            <tr>
                <td>公共運輸</td>
                <td>捷運中正紀念堂站3號出口</td>
            </tr>
            <tr>
                <td>聯絡電話</td>
                <td>02 2327 8177</td>
            </tr>
            <tr>
                <td>營業時間</td>
                <td>10:30 - 22:00</td>
            </tr>
            <tr>
                <td>其他聯絡資訊</td>
                <td><a target="_blank" href="https://tw.bid.yahoo.com/booth/Y1560771138?bfe=1
                ">yahoo 賣場</a></td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</section>
@endsection
        