<input type="hidden" value="{{ json_encode(config('seoscore')) }}" data-scoring>
<li class="mr-1">
	@button(['element'=>'button', 'color'=>'blue','label'=>'Check SEO Score', 'attr'=>arrayToHtmlAttributes(['data-toggle' => 'modal', 'data-target' => '#toolModal', 'data-url' => url('/post/seo-score')]), 'class' => 'btn btn-primary btn-block mt-2 mb-2 px-5'])
</li>
