@extends('layouts/app') 
@section('script')
<script>
	/**
 * Number.prototype.format(n, x)
 * 
 * @param integer n: length of decimal
 * @param integer x: length of sections
 */
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};


var cart =  {!! $cart !!}
var id,pclass,pid
var total_price = 0
var cart_data = ''

cart.forEach(e => {
	console.log(e)
	total = e.product.price*e.qty
	id = e.id
	pclass = e.product.class
	pid = e.product.id
	cart_data += '<tr>\
		<td><a href="{{url('/')}}\/products\/'+pclass+'\/'+pid+'\/detail" target="_blank">'+e.product.name+'</a><input type="hidden" value="'+e.product.name+'" name="name[]"></td>\
		<td>'+e.product.price.format()+'<input type="hidden" value="'+e.product.price+'" name="price[]"></td>\
		<td>'+e.qty+'<input type="hidden" value="'+e.qty+'" name="qty[]"></td>\
		<td>'+total.format()+'</td>\
		<td>'+e.created_at+'</td>\
		<td><button class="btn btn-danger btn-sm rounded-0 btn-delete" data-id="'+id+'" >刪除</button></td>\
	</tr>'
	total_price += total
});
$('#cart').html(cart_data)
$('.price').text('價錢: NT$ '+total_price.format())


$('.btn-delete').on('click',function(e){
	e.preventDefault();
	var tr = e.currentTarget.parentElement.parentElement
	var id = e.currentTarget.dataset.id
	console.log(id)
	var url = window.location.href
	$.post( url+'/delete' , {'id':id } , function(resp){
		console.log(resp)
		$('.price').text('價錢: NT$ '+ parseInt(resp.price).format() )
		$('.shopping-cart-bubble').text(resp.number)
	})
	$(tr).fadeOut( 250, function(){
		$(this).remove();
	});	
})

</script>
@endsection
 
@section('content')
<div class="px-3 px-lg-5 spacing">
	<div class="container">
		<form id="cart-info" method="post">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead class="thead-dark">
						<tr>
							<th>商品</th>
							<th>單價</th>
							<th>數量</th>
							<th>總計</th>
							<th>產生時間</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody id="cart"></tbody>
				</table>
			</div>

			<div class="float-right d-flex align-items-center">
				<h5 class="price d-inline-block"></h5>
				<input type="submit" class="btn btn-outline-danger rounded-0 ml-3 checkout" value="下訂單" formaction="{{url('/')}}/payment/order">
			</div>
		</form>
	</div>
</div>
@endsection