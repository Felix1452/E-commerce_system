@extends('main')
@section('content')

    <div style="height: 100px">

    </div>
	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="post">
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Gửi mail đến tôi
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Nhập email của bạn">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Tôi có thể giúp gì cho bạn ?"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Gửi
						</button>
                        @csrf
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Địa chỉ
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								HP Store Sư phạm kỹ thuật VL
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								ĐT
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
                                <a href="tel:0975319991">097 531 9991</a>
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Support
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
                                <a href="mailto:19004158@st.vlute.edu.vn">19004158@st.vlute.edu.vn</a>
                                <a href="mailto:19004071@st.vlute.edu.vn">19004071@st.vlute.edu.vn</a>

							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


    <div id="map" style="width:100%;height:500px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15704.576624311765!2d105.9618098!3d10.249955400000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x451cc8d95d6039f8!2zVHLGsOG7nW5nIMSQSCBTxrAgcGjhuqFtIEvhu7kgdGh14bqtdCBWxKluaCBMb25n!5e0!3m2!1svi!2s!4v1654436631425!5m2!1svi!2s" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


@endsection
