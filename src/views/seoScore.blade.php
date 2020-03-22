@extends('vellum::modal')

@push('css')

@endpush

@section('head')
    @include('vellum::modal.header-buttons', ['rightBtnClass' => 'hide', 'attributes' => arrayToHtmlAttributes(['id' => 'insert-shortcode', 'disabled' => 'disabled'])])
@endsection

@section('content')
<div class="px-3">
	<input type="hidden" value="{{ $scoring }}" data-scoring>
	<div class="container-fluid ml-0 mr-0 pl-0 pr-0">
		<div class="col-md-6 pl-0 mb-5">
			<label class="cf-label">Keyword</label>
			<input type="text" class="cf-input" data-keyword disabled>
		</div>
	</div>

	<table class="table table-bordered">
		<thead>
            <tr>
                <th class="border-none">Criteria</th>
                <th class="border-none text-center">Score</th>
            </tr>
        </thead>
        <tbody>
        	<tr>
        		<td class="seo-criteria">SEO Title - must contain the keyword</td>
                <td class="text-center" seo-score1>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">SEO Title - length must not exceed 60 characters</td>
                <td class="text-center" seo-score2>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">SEO Title - uses power words</td>
				<td class="text-center" seo-score3>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">Meta Description - must not exceed 300 characters</td>
				<td class="text-center" seo-score4>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">Meta Description - keyword is used</td>
				<td class="text-center" seo-score5>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">Main Content - length is at least 700 words</td>
				<td class="text-center" seo-score6>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">Main Content - Keyword is used in the body of the article</td>
				<td class="text-center" seo-score7>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">Main Content - Images must have description (Alt text)</td>
				<td class="text-center" seo-score8>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">Main Content - Use of header tags</td>
				<td class="text-center" seo-score9>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria">Main Content - Use of keyword in header tags</td>
				<td class="text-center" seo-score10>0</td>
        	</tr>
        	<tr>
        		<td class="seo-criteria"><strong>SEO Score</strong></td>
                <td class="text-center">
                    <strong><span seo-total-score>0</span></strong>
                </td>
        	</tr>
        </tbody>
	</table>
</div>
@endsection


@push('scripts')
<script type="text/javascript" src="{{ asset('vendor/seoscore/js/seo_score.js') }}"></script>
<script type="text/javascript">

	$(document).ready(function(){
		generateSeoScore('modal');
	});

</script>
@endpush

