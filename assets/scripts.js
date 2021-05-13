jQuery(document).ready(function($) {
	if (vp_page_videos) {
		jQuery.each(vp_page_videos, function(index, el) {
			let ID = index + 1;
			jQuery('a[href="#vp-video-'+ID+'"], .vp-video-'+ID).magnificPopup({
				items: {
					src: '#vp-video-popup',
					type: 'inline'
				},
				callbacks: {
					close: function(){
						jQuery('#vp-video-popup').empty();
					}
				}
			});
			jQuery('a[href="#vp-video-'+ID+'"], .vp-video-'+ID).click(function(){
				let vp_html = '';
				if (el['type'] == 'Self-hosted') {
					vp_html += '<video id="vp-player" playsinline controls data-poster="'+el['video']['poster']['url']+'">';
					vp_html += '<source src="'+el['video']['video_file']['url']+'" type="video/mp4" />'
					vp_html += '</video>';
					
				} else if (el['type'] == 'YouTube') {
					vp_html += '<div class="plyr__video-embed" id="vp-player">';
					vp_html += '<iframe src="https://www.youtube.com/embed/'+el['video']['youtube_video_id']+'?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" ';
    				vp_html += 'allowfullscreen allowtransparency allow="autoplay"></iframe></div>';
				} else if (el['type'] == 'Vimeo') {
					vp_html += '<div class="plyr__video-embed" id="vp-player">';
					vp_html += '<iframe src="https://player.vimeo.com/video/'+el['video']['vimeo_video_id']+'?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" ';
					vp_html += 'allowfullscreen allowtransparency allow="autoplay"></iframe></div>';
				}
				jQuery('#vp-video-popup').html(vp_html);
				const player = new Plyr('#vp-player');
			});
		});
	}
});