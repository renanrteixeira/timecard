<!-- Select2 -->
<script src="<?php echo base_url('/assets/bower_components/select2/dist/js/select2.full.min.js')?>"></script>
<script>

			

			// Set the "bootstrap" theme as the default theme for all Select2
			// widgets.
			//
			// @see https://github.com/select2/select2/issues/2927
			$.fn.select2.defaults.set( "theme", "bootstrap" );

			var placeholder = "Selecione um item";

			$( ".select2-single, .select2-multiple" ).select2( {
				allowClear: true,
				placeholder: placeholder,
				width: '100%',
				containerCssClass: ':all:'
			} );

			$( ".select2-allow-clear" ).select2( {
				allowClear: true,
				placeholder: placeholder,
				width: '100%',
				containerCssClass: ':all:'
			} );

			// @see https://select2.github.io/examples.html#data-ajax
			function formatRepo( repo ) {
				if (repo.loading) return repo.text;

				var markup = "<div class='select2-result-repository clearfix'>" +
					"<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
					"<div class='select2-result-repository__meta'>" +
						"<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

				if ( repo.description ) {
					markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
				}

				markup += "<div class='select2-result-repository__statistics'>" +
							"<div class='select2-result-repository__forks'><span class='glyphicon glyphicon-flash'></span> " + repo.forks_count + " Forks</div>" +
							"<div class='select2-result-repository__stargazers'><span class='glyphicon glyphicon-star'></span> " + repo.stargazers_count + " Stars</div>" +
							"<div class='select2-result-repository__watchers'><span class='glyphicon glyphicon-eye-open'></span> " + repo.watchers_count + " Watchers</div>" +
						"</div>" +
					"</div></div>";

				return markup;
			}

			function formatRepoSelection( repo ) {
				return repo.full_name || repo.text;
			}

			$( ".js-data-example-ajax" ).select2({
				width : null,
				containerCssClass: ':all:',
				ajax: {
					url: "https://api.github.com/search/repositories",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page
						};
					},
					processResults: function (data, params) {
						// parse the results into the format expected by Select2
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data, except to indicate that infinite
						// scrolling can be used
						params.page = params.page || 1;

						return {
							results: data.items,
							pagination: {
								more: (params.page * 30) < data.total_count
							}
						};
					},
					cache: true
				},
				escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				minimumInputLength: 1,
				templateResult: formatRepo,
				templateSelection: formatRepoSelection
			});

			$( "button[data-select2-open]" ).click( function() {
				$( "#" + $( this ).data( "select2-open" ) ).select2( "open" );
			});

			$( ":checkbox" ).on( "click", function() {
				$( this ).parent().nextAll( "select" ).prop( "disabled", !this.checked );
			});

			// copy Bootstrap validation states to Select2 dropdown
			//
			// add .has-waring, .has-error, .has-succes to the Select2 dropdown
			// (was #select2-drop in Select2 v3.x, in Select2 v4 can be selected via
			// body > .select2-container) if _any_ of the opened Select2's parents
			// has one of these forementioned classes (YUCK! ;-))
			$( ".select2-single, .select2-multiple, .select2-allow-clear, .js-data-example-ajax" ).on( "select2:open", function() {
				if ( $( this ).parents( "[class*='has-']" ).length ) {
					var classNames = $( this ).parents( "[class*='has-']" )[ 0 ].className.split( /\s+/ );

					for ( var i = 0; i < classNames.length; ++i ) {
						if ( classNames[ i ].match( "has-" ) ) {
							$( "body > .select2-container" ).addClass( classNames[ i ] );
						}
					}
				}
			});

		</script>
