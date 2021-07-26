<!-- HowToUseモーダルの設定 -->
<div class="modal fade" id="howToUseModal" tabindex="-1" aria-labelledby="howToUseModalLabel">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="howToUseModalLabel">使い方</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
			</div>
			<div class="modal-body">
				<div id="carouselHowToUse" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="false">
					<!-- インジケータの設定 -->
					<div class="carousel-indicators">
						<button type="button" data-bs-target="#ccarouselHowToUse" data-bs-slide-to="0"
							class="active" aria-current="true" aria-label="スライド 1"></button>
						<button type="button" data-bs-target="#carouselHowToUse" data-bs-slide-to="1"
							aria-label="スライド 2"></button>
						<button type="button" data-bs-target="#carouselHowToUse" data-bs-slide-to="2"
							aria-label="スライド 3"></button>
					</div>
					<!-- スライドさせる画像の設定 -->
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="{{ asset('img/1.png') }}" class="img-fluid" alt="">
						</div><!-- /.carousel-item -->
						<div class="carousel-item">
							<img src="{{ asset('img/2.png') }}" class="img-fluid" alt="">
						</div><!-- /.carousel-item -->
						<div class="carousel-item">
							<img src="{{ asset('img/3.png') }}" class="img-fluid" alt="">
						</div><!-- /.carousel-item -->
					</div><!-- /.carousel-inner -->
					<!-- スライドコントロールの設定 -->
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselHowToUse"
						data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">前へ</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselHowToUse"
						data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">次へ</span>
					</button>
				</div><!-- /.carousel -->
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
			</div><!-- /.modal-footer -->
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
