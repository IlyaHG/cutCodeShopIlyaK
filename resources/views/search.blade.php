@include('parts/header')

 <main class="py-16 lg:py-20">
	 <div class="container">

		<section>
			<!-- Section heading -->
			<h2 class="text-lg lg:text-[42px] font-black">Поиск по запросу: Steelseries</h2>

			<!-- Products list -->
			<div class="products grid grid-cols-4 gap-x-8 gap-y-12 mt-12">
				@include('parts/products/1')
				@include('parts/products/2')
				@include('parts/products/1')
				@include('parts/products/2')
			</div>

			<!-- Page pagination -->
			<div class="mt-12">
				@include('parts/pagination')
			</div>
		</section>

	</div>
 </main>

@include('parts/footer')