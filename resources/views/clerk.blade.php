@extends('layouts/app')

@section('clerk-nav','active')

@section('style')
<style>
.hover-text {
	margin: 15px 15px 0;
	padding: 0;
}
.hover-text:last-child {
	padding-bottom: 60px;
}
.hover-text::after {
	content: '';
	clear: both;
	display: block;
}
.hover-text div span {
	z-index: -1;
	display: block;
	width: 100%;
    height: 0;
	margin: 0;
	padding: 0;
	color: #444;
	font-size: 18px;
	text-decoration: none;
	text-align: left;
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
	opacity: 0;
    transform: translateY(-100%);
}
figure {
	margin: 0;
	padding: 0;
	background: #fff;
	overflow: hidden;
    z-index: 2;
}
figure:hover+span {
	opacity: 1;
    height: auto;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
    transform: translateY(0);
}
/* Shine */
.hover-shine figure {
	position: relative;
}
.hover-shine figure::before {
	position: absolute;
	top: 0;
	left: -75%;
	z-index: 2;
	display: block;
	content: '';
	width: 50%;
	height: 100%;
	background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,.3) 100%);
	background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,.3) 100%);
	-webkit-transform: skewX(-25deg);
	transform: skewX(-25deg);
}
.hover-shine figure:hover::before {
	-webkit-animation: shine .75s;
	animation: shine .75s;
}
@-webkit-keyframes shine {
	100% {
		left: 125%;
	}
}
@keyframes shine {
	100% {
		left: 125%;
	}
}
</style>
@endsection

@section('content')
<div class="px-3 px-lg-5 spacing">
    <div class="container">
        <div class="row hover-shine hover-text">
            <div class="col-md-4">
                <figure><img src="/images/24-cat.jpg" /></figure>
                <span><b>24磅的吉祥物，是一隻有很多神奇道具的貓，雖然身體不太好，但是牠還是不遺餘力的使用道具幫助她的主人文婷</b></span>
            </div>
            <div class="col-md-4">
                <figure><img src="/images/24-wantin.jpg" /></figure>
                <span><b>24磅的店員，永遠長不大，興趣是攝影跟吃，希望有一天可以獨立自主讓自己不用再依靠磅磅的道具</b></span>
            </div>
            <div class="col-md-4">
                <figure><img src="/images/24-boss.jpg" /></figure>
                <span><b>24磅的老闆，喜歡在球場上用炫麗的球技欺負他的店員，事後再泡好喝的咖啡讓人很難生氣</b></span>
            </div>
        </div>
    </div>
</div>
@endsection