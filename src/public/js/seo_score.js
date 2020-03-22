//transfer this to another js file; pass origin whether's it's on form or in the iframe
var generateSeoScore = function(origin) {
	var scoring = JSON.parse($('[data-scoring]').val()),
	keyword, seoTitle, seoTitleWordCount, metaDesc, metaDescCount, content,
	contentWordCount, seoTotalScore, seoScoreBreakdown = '',
	total = 0,
	totalBreakdown = {1:0, 2:0, 3:0, 4:0, 5:0, 6:0, 7:0, 8:0, 9:0, 10:0},
	powerWordUsage = '/power-words/check-usage';

	if (origin == 'modal') {
		keyword = $('#seo_keyword', window.parent.document).val().trim();
		seoTitle = $('#meta_title', window.parent.document).val().trim();
		seoTitleWordCount = $('#count-meta_title', window.parent.document).text();
		metaDesc = $('#meta_description', window.parent.document).val().trim();
		metaDescCount = $('#count-meta_description', window.parent.document).text();
		content = parent.tinymce.get('content').getContent({ format: 'html' });
		contentWordCount = window.parent.wordCount(content);
		seoTotalScore = $('#total_seo_score', window.parent.document);
		seoScoreBreakdown = $('#seo_score_breakdown', window.parent.document);
	} else if (origin == 'form') {
		keyword = $('#seo_keyword').val().trim();
		seoTitle = $('#meta_title').val().trim();
		seoTitleWordCount = $('#count-meta_title').text();
		metaDesc = $('#meta_description').val().trim();
		metaDescCount = $('#count-meta_description').text();
		content = tinymce.get('content').getContent({ format: 'html' });
		contentWordCount = wordCount(content);
		seoTotalScore = $('#total_seo_score');
		seoScoreBreakdown = $('#seo_score_breakdown');
	}

	$('[data-keyword]').val(keyword);

	/* SEO Title - must contain the keyword */
	if (keyword != '' && seoTitle.toLowerCase().indexOf(keyword.toLowerCase()) >= 0) {
		$('[seo-score1]').text(scoring[1]);
		totalBreakdown[1] += scoring[1];
		total += scoring[1];
	}

	/* SEO Title - length must not exceed 60 characters */
	if (seoTitleWordCount > 0 && seoTitleWordCount <= 60) {
		$('[seo-score2]').text(scoring[2]);
		totalBreakdown[2] += scoring[2];
		total += scoring[2];
	}

	/* SEO Title - uses power words */
	ajaxPartialUpdate(powerWordUsage, 'POST', {keyword:keyword, seoTitle:seoTitle}).then(function(response){
		if (response.aWordExists) {
			seoTotalScore.empty();
			$('[seo-score3]').text(scoring[3]);
			totalBreakdown[3] += scoring[3];
			total += scoring[3];

			$('[seo-total-score]').text(total);
			seoTotalScore.val(total);
			seoScoreBreakdown.val(JSON.stringify(totalBreakdown));
		}
	});

	/* Meta Description - must not exceed 300 characters */
	if (metaDescCount > 0 && metaDescCount <= 300) {
		$('[seo-score4]').text(scoring[4]);
		totalBreakdown[4] += scoring[4];
		total += scoring[4];
	}

	/* Meta Description - keyword is used */
	if (keyword != '' && metaDesc.toLowerCase().indexOf(keyword.toLowerCase()) >= 0) {
		$('[seo-score5]').text(scoring[5]);
		totalBreakdown[5] += scoring[5];
		total += scoring[5];
	}

	/* Main Content - length is at least 700 words */
	if (contentWordCount >= 700) {
		$('[seo-score6]').text(scoring[6]);
		totalBreakdown[6] += scoring[6];
		total += scoring[6];
	}

	/* Main Content - Keyword is used in the body of the article */
	if (keyword != '' && content.toLowerCase().indexOf(keyword.toLowerCase()) >= 0) {
		$('[seo-score7]').text(scoring[7]);
		totalBreakdown[7] += scoring[7];
		total += scoring[7];
	}

	/* Main Content - Images must have description (Alt text) */
	if (content != '' && content.toLowerCase().indexOf('alt=""') == -1 && content.toLowerCase().indexOf('alt="') >= 0) {
		$('[seo-score8]').text(scoring[8]);
		totalBreakdown[8] += scoring[8];
		total += scoring[8];
	}

	/* Main Content - Use of header tags */
	if ((content.toLowerCase().indexOf('<h1>') >= 0 ||
		content.toLowerCase().indexOf('<h2>') >= 0 ||
		content.toLowerCase().indexOf('<h3>') >= 0 ||
		content.toLowerCase().indexOf('<h4>') >= 0 ||
		content.toLowerCase().indexOf('<h5>') >= 0 ||
		content.toLowerCase().indexOf('<h6>') >= 0) &&
		content != ''){

		$('[seo-score9]').text(scoring[9]);
		totalBreakdown[9] += scoring[9];
		total += scoring[9];
	}

	/* Main Content - Use of keyword in header tags */
	if ((content.toLowerCase().indexOf('<h1>') >= 0 ||
		content.toLowerCase().indexOf('<h2>') >= 0 ||
		content.toLowerCase().indexOf('<h3>') >= 0 ||
		content.toLowerCase().indexOf('<h4>') >= 0 ||
		content.toLowerCase().indexOf('<h5>') >= 0 ||
		content.toLowerCase().indexOf('<h6>') >= 0) &&
		content != '' && keyword != '') {

		var h1 = content.match('<h1>(.*)</h1>'),
			h2 = content.match('<h2>(.*)</h2>'),
			h3 = content.match('<h3>(.*)</h3>'),
        	h4 = content.match('<h4>(.*)</h4>'),
        	h5 = content.match('<h5>(.*)</h5>'),
        	h6 = content.match('<h6>(.*)</h6>');

        	if ((h1 != null && h1[1].toLowerCase().match(keyword.toLowerCase())) ||
        		(h2 != null && h2[1].toLowerCase().match(keyword.toLowerCase())) ||
        		(h3 != null && h3[1].toLowerCase().match(keyword.toLowerCase())) ||
        		(h4 != null && h4[1].toLowerCase().match(keyword.toLowerCase())) ||
        		(h5 != null && h5[1].toLowerCase().match(keyword.toLowerCase())) ||
        		(h6 != null && h6[1].toLowerCase().match(keyword.toLowerCase()))) {

        		$('[seo-score10]').text(scoring[10]);
        		totalBreakdown[10] += scoring[10];
				total += scoring[10];
        	}
	}

	$('[seo-total-score]').text(total);
	seoTotalScore.val(total);
	seoScoreBreakdown.val(JSON.stringify(totalBreakdown));
}


