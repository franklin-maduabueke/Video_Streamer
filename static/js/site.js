$().ready(function () {
    
    //login btn script
    $('button#btnLogin').click(function () {
        $('form#formSignIn').submit();
    });

    //search link script running ajax
    if ($('a#ajaxsearchlink').length)
    {
        //document click will hide search input box
        $(document).click(function () {
            if ($.trim($('input.txtSearchQuery').val()).length == 0 && ! $('div#search-query-input-container').hasClass('hidden'))
            {
                $('div#search-query-input-container').addClass('hidden');
                $('a#ajaxsearchlink').toggle();

                //show banner and main page content with animate
                $('div#home-page-search-content-body').animate({
                    opacity : '0',
                }, 400, function () {
                    $(this).addClass('hidden');
                });
                
                
                $('div#home-page-main-content-body, div#homebanner')
                .removeClass('hidden').animate({
                    opacity : '1',
                }, 1000);
            }
        });
    
        $('div#search-query-input-container input.txtSearchQuery').click(function (e) {
            e.stopPropagation();
        });

        $('div#search-query-input-container i.icon-cross').click(function (e) {
            e.stopPropagation();
            $('div#search-query-input-container input.txtSearchQuery').val('');
        })

        $('a#ajaxsearchlink').click(function (e) {
            e.preventDefault();
            e.stopPropagation();

            $('div#search-query-input-container').removeClass('hidden')
            .animate({width: '300px'}, 100)
            .children('input').focus();

            $(this).toggle();

            //hide banner and main page content with animate
            $('div#home-page-main-content-body, div#homebanner').animate({
                opacity : '0',
            }, 700, function () {
                $('div#home-page-main-content-body, div#homebanner').addClass('hidden');
            })

            $('div#home-page-search-content-body').animate({
                opacity : '1',
            }, 700, function () {
                $(this).removeClass('hidden');
            });
        });

        //sorting script
        $('select#cbSortBy').click((e) => e.stopPropagation())
        .change(function () {
            var order_by = $(this).val();
            var order_cards = $('.card-and-details-container:not(:hidden)');
            var content_body = $('.content-body:not(:hidden)');
            var all_tiles = $('.tile:not(:hidden)');

            //take all tiles out and add to each available card in reverse
            var total_unused = all_tiles.length;

            order_cards.each(function (idx, elm) {
                var row_inner = $(this).find('.row__inner:not(:hidden)');
                for (i = 0; total_unused >= 0 && i < 5; ++i, --total_unused)
                    row_inner.append( $(all_tiles[total_unused - 1]) );
            });
        });

        //on keydown start search
        var repopulateTilesHnd = null;
        var pid_gen = -1;
        $('input.txtSearchQuery').keyup(function (event) {
            var searchQuery = $.trim($(this).val());

            if (searchQuery.length >= 2)
            {
                if (repopulateTilesHnd != null)
                {
                    clearTimeout(repopulateTilesHnd);
                    repopulateTilesHnd = null;
                }

                //clear all cards but the first card. remove tiles in first but one used for cloning
                //then create and populate with extra cards with tiles of 5 per set.
                var all_cards = $('div.card:not(:hidden)');
                if (all_cards.length > 1)
                    all_cards.not(all_cards[0]).parent().remove();
                
                var tiles = $(all_cards[0]).find('div.tile:not(:hidden)');
                tiles.not(tiles[0]).remove();

                $.ajax({
                    url : $('input#api-video-search-endpoint').val() + searchQuery,
                    dataType : 'json',
                    data : {
                        'query' : searchQuery,
                        'pid' : ++pid_gen
                    },
                    method : 'POST',
                    success : function (data, textStatus, jqXHR){
                        if (data.success && pid_gen == data.pid)
                        {
                            repopulateTilesHnd = setTimeout(function () {
                                var site_base_url = $('input#site-base-url').val();

                                //calculate number of cars needed for set of 5 tiles
                                var cards_required = Math.ceil(data.count / 5.0);
                                
                                //create cards from only surviving card
                                for (i = 0; i < cards_required - 1; ++i)
                                    $('div.content-body:not(:hidden)').append($(all_cards[0]).parent().clone(true, true));

                                //get all cards
                                var num_tiles_left = data.results.length;
                                var total_displayed = 0;

                                $('div.card:not(:hidden)').each(function (index, elem) {
                                    var first_tile = $(elem).find('div.tile:first:not(:hidden)');
                                    var row_inner = $(elem).find('div.row__inner:not(:hidden)');
                                    
                                    //add five and remove first as it is old
                                    for (tcount = 0; total_displayed < num_tiles_left && tcount < 5; ++tcount)
                                    {
                                        row_inner.append(first_tile.clone(true, true));
                                        var current_tile = row_inner.find('div.tile:last:not(:hidden)');

                                        current_tile.children('input.video-actors').val(data.results[total_displayed].actors);
                                        current_tile.children('input.video-directors').val(data.results[total_displayed].directors);
                                        current_tile.children('input.video-creators').val(data.results[total_displayed].creators);
                                        current_tile.children('input.video-genres').val(data.results[total_displayed].categoryname);

                                        current_tile.children('.tile__details').find('.tile__title a').text(data.results[total_displayed].title);                                    
                                        current_tile.children('.tile__details').find('.title_description').html(data.results[total_displayed].description);
                                        
                                        var tile_media = current_tile.children('div.tile__media');
                                        tile_media.children('img').remove();

                                        //add cover images
                                        var tile_img_template = null;
                                        if ($.trim(data.results[total_displayed].cover_image).length > 0)
                                        {
                                            tile_img_template = '<img class="tile__img" src="' + site_base_url + 'media_source/video_cover/' + data.results[total_displayed].cover_image + '" alt=""  />';
                                            tile_media.append(tile_img_template);
                                        }

                                        //add vidly posters
                                        if ($.trim(data.results[total_displayed].cover_image).length > 0)
                                        {
                                            tile_img_template = '<img class="tile__img" style="opacity:0;" src="http://vid.ly/' + data.results[total_displayed].vidly_url +'/poster" alt=""  />';
                                            tile_media.append(tile_img_template);

                                            tile_img_template = '<img class="tile__img" style="opacity:0;" src="http://vid.ly/' + data.results[total_displayed].vidly_url + '/poster2" alt=""  />';
                                            tile_media.append(tile_img_template);

                                            tile_img_template = '<img class="tile__img" style="opacity:0;" src="http://vid.ly/' + data.results[total_displayed].vidly_url + '/poster3" alt=""  />';
                                            tile_media.append(tile_img_template);
                                        }
                                        else
                                        {
                                            tile_img_template = '<img class="tile__img" src="http://vid.ly/' + data.results[total_displayed].vidly_url + '/poster" alt=""  />';
                                            tile_media.append(tile_img_template);

                                            tile_img_template = '<img class="tile__img" style="opacity:0;" src="http://vid.ly/' + data.results[total_displayed].vidly_url + '/poster2" alt=""  />';
                                            tile_media.append(tile_img_template);

                                            tile_img_template = '<img class="tile__img" style="opacity:0;" src="http://vid.ly/' + data.results[total_displayed].vidly_url + '/poster3" alt=""  />';
                                            tile_media.append(tile_img_template);
                                        }

                                        total_displayed++;
                                    }

                                    first_tile.remove();
                                });
                            }, 300);
                        }
                        else
                        {
                            if (repopulateTilesHnd != null)
                            {
                                clearTimeout(repopulateTilesHnd);
                                repopulateTilesHnd = null;
                            }
                        }
                    },
                    error : function (jqXHR, textStatus, errorStatus) {
                        //alert("Error: " + errorStatus);
                    }
                });
            }
        });
    }

    //mobile advert area script 
    if ($('div#vp-mobile-advert-area').length)
    {
        $('div#vp-mobile-advert-area').click(function () {
            //show modal order form
        });
    }

    //admin dashboard script;
    if ($('button#btnUplodaHomeBanner').length)
    {
        $('button#btnUplodaHomeBanner').click(function () {
            if ($('input#fileHomeBannerImageFile').val().length == 0)
            {
                alert("Please select image file to change banner");
                return;
            }

            if (confirm('Do you want to upload banner image?'))
                $('form#formUploadHomeBanner').submit();
            
        });
    }

    //homepage nav script
    if ($('nav#homepagenavbar').length)
    {
        $(document).scroll(function (){
            if ($(document).scrollTop() > 0)
                $('div#navbg').removeClass('hidden');
            else
                $('div#navbg').addClass('hidden');
        });

        //remove padding-left and margin-left for mobile
        if ($('div.navbar-container').css('display') != 'block')
        {
            $('div.card-body').css({'margin-left': '0px', 'padding-left': '0px'});
            $('div.carouselTitle').css({'margin-left': '20px', 'padding-left': '0px'});
        }
    }

    //admin change password script
    if ($('form#formChangePassword').length)
    {
        $('button#btnSubmitNewPassword').click(function (){
            var oldpass = $.trim($('input#txtOldPassword').val());
            var newpass = $.trim($('input#txtNewPassword').val());
            var confirmpass = $.trim($('input#txtNewPasswordConfirm').val());

            if (oldpass.length == 0)
            {
                alert("Please enter your old password!");
                return;
            }

            if (newpass.length == 0 || confirmpass.length == 0 || newpass != confirmpass)
            {
                alert("Please enter your new password and confirmation to match!");
                return;
            }

            if (confirm('Do you want to change your password?'))
                $('form#formChangePassword').submit();
        });
    }

    //carousel controls script
    if ($('div#netflixcarouselContainer').length)
    {
        var ajust_scroll_amount = null;
        var ADJUST_MAX_AMOUNT = 200;
        var ADJUST_DEFAULT_AMOUNT = 525;

        var mouseOnCarouselControl = false;
        var lbtn = $('button.carouselLCtrl');
        var rbtn = $('button.carouselRCtrl');

        $(lbtn).add(rbtn).hover(function (e) {
            e.stopPropagation();
            mouseOnCarouselControl = true;
        })
        .mouseleave(function (e) {
            mouseOnCarouselControl = false;
        });

        lbtn.data('last-right', 0);
        rbtn.data('last-left', 0);
        $(lbtn).siblings('div.row__inner').data('pos', 0);

        lbtn.css('left', '0px');
        rbtn.css('left', ($(window).width() - rbtn.width() - 50) + 'px');
        lbtn.height(lbtn.siblings('div.row__inner').height());
        rbtn.height(rbtn.siblings('div.row__inner').height());
        
        $(window).resize(function () {
            lbtn.css('left', '0px');
            rbtn.css('left', ($(window).width() - rbtn.width() - 50) + 'px');
            lbtn.height(lbtn.siblings('div.row__inner').height());
            rbtn.height(rbtn.siblings('div.row__inner').height());
        })

        lbtn.click(function () {
            //transition a page to the right
            var last_right = $(this).data('last-right');
            var scroller = $(this).siblings('div.row__inner');
            var pos = parseInt(scroller.data('pos'));

            if (pos < 0)
            {
                last_right = pos + ajust_scroll_amount;
                $(this).data('last-right', last_right);
                var scroller_left_pos = scroller.offset().left;

                if (scroller_left_pos + parseInt(last_right) > 0)
                    last_right = -1 * scroller.offset().left;

                var trans = 'translate(' + last_right + 'px, 0)';

                scroller.css({'-webkit-transform': trans});
                scroller.css({'transform': trans});
                scroller.data('pos', last_right);
                $(this).siblings('button.carouselRCtrl').removeClass('hidden');
            }
            else
            {
                $(this).data('last-right', 0)
                $(this).addClass('hidden');
            }
        });

        rbtn.click(function () {
            //transition a page to the left
            var last_left = $(this).data('last-left');
            var scroller = $(this).siblings('div.row__inner');
            var pos = parseInt(scroller.data('pos'));

            if ($(this).siblings('div.row__inner').children('.tile').length > 5)
            {
                if (pos > -scroller.width() * 0.32)
                {
                    last_left = pos - ajust_scroll_amount;

                    $(this).data('last-left', last_left);

                    var trans = 'translate(' + last_left + 'px, 0)';

                    scroller.css({'-webkit-transform': trans});
                    scroller.css({'transform': trans});
                    scroller.data('pos', last_left);
                    $(this).siblings('button.carouselLCtrl').removeClass('hidden');
                }
                else
                {
                    $(this).data('last-left', 0);
                    $(this).addClass('hidden');
                }
            }
        });

        $('div.row__inner').hover(function(e){
            e.stopPropagation();
            var lbtn = $(this).siblings('button.carouselLCtrl');
            var rbtn = $(this).siblings('button.carouselRCtrl');

            lbtn.css('left', '18px');
            rbtn.css('left', ($(window).width() - rbtn.width() - 10) + 'px');
            lbtn.css('top', '10px');
            rbtn.css('top', '10px');

            lbtn.height($(this).height());
            rbtn.height($(this).height());

            if ($(this).data('pos') != 0)
                lbtn.removeClass('hidden');

            if ($(this).children('.tile').length > 5)
                rbtn.removeClass('hidden');
        })
        .mouseleave(function (e) {
            //if (!mouseOnCarouselControl) {
                $(this).siblings('button.carouselLCtrl').addClass('hidden');
                $(this).siblings('button.carouselRCtrl').addClass('hidden');
            //}
        });
        
        
        var scrollTileImageClockHandler = null;
        var scrollTileImageCount = 0;
        var currentTileObj = null;

        //used hover on body to remove control arrows on screen
        $(document).on('mouseover',function () {
            //alert("Body hover");
            $('div.row__inner').mouseleave();
        });

        $('div.tile').click(function () {
            window.location.href = $(this).find('div.tile__title a').attr('href');
        })
        .hover(function (e) {
            e.stopPropagation();
            $(this).parent().mouseover();
            
            currentTileObj = this;
            $(this).data('image_count', $(currentTileObj).find('.tile__media img').length);

            $(currentTileObj).parentsUntil('div.card')
            .parent()
            .siblings('div.title_full_details_container:first')
            .css('z-index', '-1');

            //show default poster image
            if (scrollTileImageClockHandler != null)
                clearInterval(scrollTileImageClockHandler);

            //tile image billboard display animation
            scrollTileImageClockHandler = setInterval(function () {
                var tile_details_panel = $(currentTileObj).parentsUntil('div.card').parent().nextAll('div.title_full_details_container:first:not(:hidden)');
                
                if (scrollTileImageCount > $(currentTileObj).data('image_count') - 2)
                {
                    //clearInterval(scrollTileImageClockHandler);
                    var ctimg = $(currentTileObj).children('.tile__media').children('img');
                    if (tile_details_panel.length == 0)
                    {
                        ctimg.not($(ctimg[0])).animate({opacity:0.0}, {duration:600});
                    }
                    else
                    {
                        var current_swtich_img0 = ctimg[0];
                        //hdsrcImg = hdsrcImg.substr(0, hdsrcImg.lastIndexOf('/')) + '/poster_hd';
                        tile_details_panel.css('background-image', 'url(' + $(current_swtich_img0).attr('src') + ')');
                    }
                    //$($(ctimg)[0]).animate({opacity:1.0}, {duration:600});

                    scrollTileImageCount = 0;
                }
                else
                {
                    var ctimg = $(currentTileObj).children('.tile__media').children('img');
                    if (tile_details_panel.length == 0)
                    {
                        //ctimg.animate({opacity:0.0}, {duration:600});
                        $($(ctimg)[++scrollTileImageCount]).animate({opacity:1.0}, {duration:600});
                    }
                    else
                    {
                        //display on details panel
                        var current_swtich_img1 = $(ctimg)[++scrollTileImageCount];
                        //hdsrcImg = hdsrcImg.substr(0, hdsrcImg.lastIndexOf('/')) + '/poster_hd';
                        tile_details_panel.css({'background-image': 'url(' + $(current_swtich_img1).attr('src') + ')'});

                        //$().animate({opacity:1.0}, {duration:600});
                    }
                }
            }, 2000);

            //shift if tile scaled is not fully displayable
            var twidth = $(this).width() * 0.5;
            var pos = $(this).offset();
            var cx = pos.left + twidth;

            if ((cx - (2.0 * twidth)) < -20)
            {
                ajust_scroll_amount = ADJUST_MAX_AMOUNT;
                $('button.carouselLCtrl').data('scroll_amount', ajust_scroll_amount);
                $(this).parent().siblings('button.carouselLCtrl').click();
            }
            else if ((cx + (2.0 * twidth)) > $('body').width())
            {
                ajust_scroll_amount = ADJUST_MAX_AMOUNT;
                $('button.carouselRCtrl').data('scroll_amount', ajust_scroll_amount);
                $(this).parent().siblings('button.carouselRCtrl').click();
            }
        })
        .mouseleave(function (e) {
            if ( ! $(this).hasClass('whiteborder'))
            {
                if ($('button.carouselRCtrl').data('scroll_amount'))
                {
                    ajust_scroll_amount = ADJUST_MAX_AMOUNT;
                    $('button.carouselLCtrl').data('scroll_amount', ajust_scroll_amount);
                    $(this).parent().siblings('button.carouselLCtrl').click();
                    $('button.carouselRCtrl').removeData('scroll_amount');
                    $('button.carouselLCtrl').removeData('scroll_amount');
                    ajust_scroll_amount = ADJUST_DEFAULT_AMOUNT;
                }

                if ($('button.carouselLCtrl').data('scroll_amount'))
                {
                    ajust_scroll_amount = ADJUST_MAX_AMOUNT;
                    $('button.carouselRCtrl').data('scroll_amount', ajust_scroll_amount);
                    $(this).parent().siblings('button.carouselRCtrl').click();
                    $('button.carouselRCtrl').removeData('scroll_amount');
                    $('button.carouselLCtrl').removeData('scroll_amount');
                    ajust_scroll_amount = ADJUST_DEFAULT_AMOUNT;
                }

                if (scrollTileImageClockHandler != null)
                    clearInterval(scrollTileImageClockHandler);

                var ctimg = $(currentTileObj).children('.tile__media').children('img');
                ctimg.not($(ctimg[0])).animate({opacity:0.0}, {duration:600});
                //$($(ctimg)[0]).animate({opacity:1.0}, {duration:600});

                scrollTileImageCount = 0;
            }

            $(this).parentsUntil('div.card').parent().siblings('div.title_full_details_container:first')
            .css('z-index', '0');
        });

        //go to play
        $('i.full_detail_playbtn').click(function () {
            if (currentTileObj !== null)
                window.location.href = $(currentTileObj).find('a').attr('href');
        });

        $('.title_full_details_container').hide();
        
        $('.content-body').delegate('.lockedtile', 'mouseover', function () {
            $(this).parent().children('div.tile').not(this)
            .removeClass('whiteborder').find('div.tilepointertodetails').addClass('hidden');

            $(this).addClass('whiteborder').find('div.tilepointertodetails').removeClass('hidden');

            var detailsPanel = $(this).parentsUntil('div.card').parent().nextAll('div.title_full_details_container:first');
            detailsPanel.find('.fd_movie_title_name a').get(0).innerText = $(currentTileObj).find('.tile__title a').get(0).innerText;
            detailsPanel.find('.fd_movie_description').get(0).innerText = $(currentTileObj).find('.title_description').get(0).innerText;

            detailsPanel.find('span.vid-actors').get(0).innerText = $(currentTileObj).find('.video-actors').val();
            detailsPanel.find('span.vid-directors').get(0).innerText = $(currentTileObj).find('.video-directors').val();
            detailsPanel.find('span.vid-creators').get(0).innerText = $(currentTileObj).find('.video-creators').val();
            detailsPanel.find('span.vid-genres').get(0).innerText = $(currentTileObj).find('.video-genres').val();

            var hdsrcImg = $(currentTileObj).find('.tile__media img').attr('src');
            //hdsrcImg = hdsrcImg.substr(0, hdsrcImg.lastIndexOf('/')) + '/poster_hd';
            detailsPanel.css('background-image', 'url(' + hdsrcImg + ')');
        })

        $('.title_details_panel_show_arrow').click(function (e) {
            e.stopPropagation();
            //show details panel
            var detailsPanel = $(this).parentsUntil('div.card').parent().nextAll('div.title_full_details_container:first');
            detailsPanel.children('div.gradient-overlay').show();
            detailsPanel.slideToggle();

            //minimize tile
            $(currentTileObj).mouseleave();
            //lock hover event from this tile row tiles
            $(currentTileObj).parent().children('div.tile')
            .addClass('lockedtile');

            $(currentTileObj).addClass('whiteborder');
            $(currentTileObj).find('div.tilepointertodetails').removeClass('hidden');

            detailsPanel.find('.fd_movie_title_name a').get(0).innerText = $(currentTileObj).find('.tile__title a').get(0).innerText;
            detailsPanel.find('.fd_movie_description').get(0).innerText = $(currentTileObj).find('.title_description').get(0).innerText;
        });
        
        $('.close-details-btn').click(function () {
            $(this).parentsUntil('.title_full_details_container').parent().fadeOut('fast');

            $(this).parentsUntil('.title_full_details_container').parent().prev('div.card')
            .find('div.tile')
            .removeClass('lockedtile whiteborder')
            .find('div.tilepointertodetails').addClass('hidden');
        });
    }

    //product place order with ajax
    if ($('button#btnPlaceorderAjaxSubmit').length)
    {
        $('button#btnDropClosePlaceorderForm').click(function () {
            var formdrop = $('div.dropdown-form-order-product');
            if (formdrop.css('display') != 'none')
                formdrop.slideUp(0.4);
        });

        $('button#btnDropPlaceorderAjaxSubmit').click(function () {
            var person_name = $.trim($('input#txtDropPersonFullname').val());
            var person_phone = $.trim($('input#txtDropPersonPhone').val());
            var quantity = $.trim($('input#txtDropOrderQuantity').val());
            var product_number = $('input#txtDropProductNumber').val();

            if (person_name.length < 3)
            {
                alert("Please enter your name to proceed!");
                return;
            }

            var regex = /[1-9][\d+]?/;
            if (!regex.test(quantity))
            {
                alert('Please enter quantity ordered!');
                return;
            }

            regex = /0[789][01]\d{8}/;
            if (!regex.test(person_phone))
            {
                alert('Please enter your local mobile phone number!');
                return;
            }

            //hide close and submit button and replace with icons for success of failure
            $('button#btnDropClosePlaceorderForm, button#btnDropPlaceorderAjaxSubmit, div#orderFormDropControlsContainer').addClass('hidden');
            $('div#orderDropPostProcessing').removeClass('hidden');

            $('i#iconDropCompleteStatus, i#iconDropErrorStatus').addClass('hidden');

            $('span#processDropMessage')[0].innerText = 'Processing...';

            var orderProductService = window.location.href;
            orderProductService = orderProductService.substring(0, orderProductService.indexOf('index.php'));
            orderProductService += 'index.php/video/submit-product-order';
            $.ajax({
                url : orderProductService,
                method : 'POST',
                dataType : 'text',
                data : {
                    'txtPersonFullname' : person_name,
                    'txtPersonPhone' : person_phone,
                    'txtOrderQuantity' : quantity,
                    'txtProductNumber' : product_number
                },
                success : function (data, status, jqXHR){
                    if (data == '1')
                    {
                        $('span#processDropMessage')[0].innerText = 'Your order was placed successfully. We will get back to you shortly. Thank you!';
                        $('i#iconDropCompleteStatus').removeClass('hidden');

                        //clear all fields
                        $('input#txtDropPersonFullname').val('');
                        $('input#txtDropPersonPhone').val('');
                        $('input#txtDropOrderQuantity').val('1')
                    }
                    else
                    {
                        $('span#processDropMessage')[0].innerText = 'Unable to complete order placement. Please try again shortly.';
                        $('i#iconDropErrorStatus').removeClass('hidden');
                    }
                },
                error : function (jqXHR, status, errorString){
                    alert("Something when wrong. (verbose): " + errorString);
                },
                complete : function () {
                    setTimeout(function () {
                        $('div#orderDropPostProcessing').addClass('hidden');
                        $('button#btnDropClosePlaceorderForm, button#btnDropPlaceorderAjaxSubmit, div#orderFormDropControlsContainer').removeClass('hidden');
                    }, 2000);
                }
            });
        });


        $('button.btnProductOrderFormLaunch').click(function () {
            //slide toggle form
            var formdrop = $('div.dropdown-form-order-product');
            $(this).parent().parent().append(formdrop);

            $('input#txtDropProductNumber').val( $(this).siblings('input#productNumber').val() );
            formdrop.find('span#productDropName').text( $(this).siblings('input#productName').val() );
            formdrop.find('span#productDropPrice').text( $(this).siblings('input#productCurrentPrice').val() );

            if (formdrop.css('display') == 'none')
                formdrop.slideToggle(); //update product number, name and price
        });

        $('button#btnPlaceorderAjaxSubmit').click(function () {
            //stop main video playing
            if (mainVideo !== null && mainVideo.readyState == 4 && !mainVideo.paused)
                mainVideo.pause(); //user will resume it

            var person_name = $.trim($('input#txtPersonFullname').val());
            var person_phone = $.trim($('input#txtPersonPhone').val());
            var quantity = $.trim($('input#txtOrderQuantity').val());
            var product_number = $('input#txtProductNumber').val();

            if (person_name.length < 3)
            {
                alert("Please enter your name to proceed!");
                return;
            }

            var regex = /[1-9][\d+]?/;
            if (!regex.test(quantity))
            {
                alert('Please enter quantity ordered!');
                return;
            }

            regex = /0[789][01]\d{8}/;
            if (!regex.test(person_phone))
            {
                alert('Please enter your local mobile phone number!');
                return;
            }

            //hide close and submit button and replace with icons for success of failure
            $('button#btnClosePlaceorderForm, button#btnPlaceorderAjaxSubmit, div#orderFormControlsContainer').addClass('hidden');
            $('div#orderPostProcessing').removeClass('hidden');

            $('i#iconCompleteStatus, i#iconErrorStatus').addClass('hidden');

            $('span#processMessage')[0].innerText = 'Processing...';

            var orderProductService = window.location.href;
            orderProductService = orderProductService.substring(0, orderProductService.indexOf('index.php'));
            orderProductService += 'index.php/video/submit-product-order';
            $.ajax({
                url : orderProductService,
                method : 'POST',
                dataType : 'text',
                data : {
                    'txtPersonFullname' : person_name,
                    'txtPersonPhone' : person_phone,
                    'txtOrderQuantity' : quantity,
                    'txtProductNumber' : product_number
                },
                success : function (data, status, jqXHR){
                    if (data == '1')
                    {
                        $('span#processMessage')[0].innerText = 'Your order was placed successfully. We will get back to you shortly. Thank you!';
                        $('i#iconCompleteStatus').removeClass('hidden');

                        //clear all fields
                        $('input#txtPersonFullname').val('');
                        $('input#txtPersonPhone').val('');
                        $('input#txtOrderQuantity').val('1')
                    }
                    else
                    {
                        $('span#processMessage')[0].innerText = 'Unable to complete order placement. Please try again shortly.';
                        $('i#iconErrorStatus').removeClass('hidden');
                    }
                },
                error : function (jqXHR, status, errorString){
                    alert("Something when wrong. (verbose): " + errorString);
                },
                complete : function () {
                    setTimeout(function () {
                        $('div#orderPostProcessing').addClass('hidden');
                        $('button#btnClosePlaceorderForm, button#btnPlaceorderAjaxSubmit, div#orderFormControlsContainer').removeClass('hidden');
                        $('button#btnClosePlaceorderForm').click();
                    }, 5000);
                }
            });
        });
    }


    //product order placement script
    if ($('form#formPlaceProductOrder').length)
    {
        $('button#btnSubmitPlaceOrder').click(function (){
            var person_name = $.trim($('input#txtPersonFullname').val());
            var person_phone = $.trim($('input#txtPersonPhone').val());
            var quantity = parseInt($.trim($('input#txtOrderQuantity').val()));

            if (person_name.length < 3)
            {
                alert("Please enter your name to proceed!");
                return;
            }

            var regex = /0[789][01]\d{8}/;
            if (!regex.test(person_phone))
            {
                alert('Please enter your local mobile phone number!');
                return;
            }

            if (isNaN(quantity) || quantity < 1)
            {
                alert('Please enter quantity ordered!');
                return;
            }

            if (confirm('Do you want to place an order for this product?'))
                $('form#formPlaceProductOrder').submit();
        });
    }

    //admin product order script
    if ($('form#formDeleteProductOrder').length)
    {
        $('a.btnRespondToProductOrder').click(function (e) {
            e.preventDefault();
            if (confirm("Do you want to mark this order as 'RESPONDED'?"))
                window.location.href = $(this).attr('href');
        });

        $('button.btnDeleteProductOrder').click(function () {
            var orderId = $(this).siblings('input[type=hidden]').val();
            if (orderId.length > 0 && confirm('Do you want to delete this product order?'))
            {
                var formObj = $('form#formDeleteProductOrder');
                formObj.children('input#txthproductorderId').val(orderId);
                formObj.submit();
            }
        });
    }

    //account register script
    if ($('button#btnSignUp').length)
    {
        $('button#btnSignUp').click(function () {
            var username = $.trim($('input#user-displayname').val());
            var email = $.trim($('input#user-email').val());
            var password = $.trim($('input#user-password').val());
            var confirmpwd = $.trim($('input#user-confirmpassword').val());

            if (username.length == 0 || username.length < 5) {
                alert('Please enter a username of at least 5 characters!');
                return;
            }

            if (email.length == 0) {
                alert('Please enter your email address!');
                return;
            }

            if (password.length == 0 || password.length < 6 || password !== confirmpwd) {
                alert('Please enter a password of at least 6 characters and enter confirmation to match!');
                return;
            }

            if (confirm('Do you want to proceed and create account?')) {
                $('form#formSignUpPost').submit();
            }
        })
    }

    //admin create membership plan script
    if ($('form#formCreateMembershipPlan, form#formEditMembershipPlan').length)
    {
        $('button#btnSubmitNewSubscriptionPlane, button#btnSubmitEditSubscriptionPlane').click(function () {
            var mp_title = $.trim($('input#txtMembershipPlanTitle').val());
            var mp_price = parseFloat($.trim($('input#txtMembershipPlanPrice').val()));
            var mp_validity_period = parseFloat($.trim($('input#txtMembershipPlanValidityPeriod').val()));
            var mp_validity_freq = $.trim($('input#txtMembershipPlanValidityFreq').val());
            var mp_description = $.trim($('textarea#txtDescription').val());

            if (mp_title.length == 0)
            {
                alert("Please enter title for plan!");
                return;
            }

            if (isNaN(mp_price) || mp_price < 0)
            {
                alert("Please enter a valid amount for price. Do not include commas.");
                return;
            }

            if (isNaN(mp_validity_period) || mp_validity_period <= 0)
            {
                alert("Please enter a valid number greater than zero for the duration!");
                return;
            }

            if (mp_description.length == 0 && !confirm("You forgot to include description for membership. Do you want to continue without it?"))
            {
                return;
            }

            if (mp_price == 0 && !confirm("You have set the subscription fee for this membership plan to zero, essentially making it free. Do you want to leave it as a FREE plan?"))
            {
                return;
            }

            //submit form
            if ($('form#formCreateMembershipPlan').length && confirm("Do you want to create membership plan(" + mp_title + ")?"))
                $('form#formCreateMembershipPlan').submit();
            
            if ($('form#formEditMembershipPlan').length && confirm("Do you want to save changes to membership plan?"))
                $('form#formEditMembershipPlan').submit();
        })
    }

    //admin subscription plans list script
    if ($('button.btnEditSubPlan').length)
    {
        $('button.btnEditSubPlan').click(function (){
            var id = $.trim($(this).siblings('input#subplankey').val());
            var site_url = $.trim($(this).siblings('input#siteurlpath').val());

            if (id.length && site_url.length)
            {
                //go to edit view
                window.location.href = site_url + "/admin/edit-subscription-plan/" + id;
            }
        });

        $('button.btnDeleteSubPlan').click(function () {
            var id = $.trim($(this).siblings('input#subplankey').val());
            var site_url = $.trim($(this).siblings('input#siteurlpath').val());

            if (id.length && site_url.length && confirm('Do you want to delete this subscription plan? Note: Deletion will only occur if no one is subscribed to this plan.'))
            {
                //go to edit view
                var delform = $('form#formDeleteSubscriptionPlan');
                delform.children('input#txthsubplanId').val(id);
                delform.submit();
            }
        });
    }

    //homeview video catalog script
    if ($('div#netflixcarouselContainer').length)
    {
        $('div.tile').click(function (){
            var video_appid = $(this).children('input[type=hidden]').val();
            //window.location.href = 'index.php/video/watch/1';
        });
    }

    //video player script
    if ($('div#video-player-embed').length)
    {
        var startAdvert = null;
        var mainVideo = null;
        var endAdvert = null;
        
        var is_desktop_viewport = $('div#desktop-related-videos-view').css('display') == 'block';

        $('i.change-view').click(function () {
            var active_view = $(this);
            active_view.toggleClass('icon-android-apps icon-android-list');

            if (active_view.hasClass('icon-android-apps'))
            {
                $('div.mvr-details').addClass('hidden')
                .css({
                    'width': '0%', 'float' : 'none'
                });

                $('div.mvr-thumbnail').css({
                    'float':'none', 'width':'100%'
                });

                $('div.mvr-thumbnail img').css('height', '100%');

                $('div.mobile-related-video-item').css({
                    'width':'50%', 'float': 'left'
                });

                $('div.mobile-related-videos-view').css('padding', '20px');
            }
            else
            {
                $('div.mvr-thumbnail').css({
                    'float':'left'
                });

                $('div.mvr-details').removeClass('hidden')
                .css({
                    'width':'55%', 'float': 'left'
                });

                $('div.mvr-thumbnail img').css('height', 'auto');

                $('div.mobile-related-video-item').css('width', '100%');
            }
        });

        $('i.change-view').click(); //make grid view default;
        
        /*script for overlay order and sponsored */
        $('div.order-product-now-overlay div#order-product').click(function (e) {
            //figure which of the order widgets to display
            if (!is_desktop_viewport)
            {
                //modal launch
                if (startAdvert != null && !startAdvert.ended)
                {
                    //modal for ordering first advert product
                    var adpnum = $('input#orderproductAds1ProductNumber').val();
                    var adpname = $('input#orderproductAds1ProductName').val();
                    var adprice = $('input#orderproductAds1CurrentPrice').val();

                    $('input#txtProductNumber').val(adpnum);
                    $('span#ordered-item-product-name').text(adpname);
                    $('span#ordered-item-price').text('Price: N' + adprice);
                }
                else if (endAdvert != null && mainVideo != null && mainVideo.ended)
                {
                    //modal for ordering first advert product
                    var adpnum1 = $('input#orderproductAds2ProductNumber').val();
                    var adpname1 = $('input#orderproductAds2ProductName').val();
                    var adprice1 = $('input#orderproductAds2CurrentPrice').val();

                    $('input#txtProductNumber').val(adpnum1);
                    $('span#ordered-item-product-name').text(adpname1);
                    $('span#ordered-item-price').text('Price: N' + adprice1);
                }

                $('div#vp-mini-ad-actionbtn').click();
            }
            else
            {
                /*
                if (startAdvert != null && ! startAdvert.ended)
                {
                    //dropdown order form for ordering first advert product
                    var adpnum1 = $('input#orderproductAds1ProductNumber').val();
                    var adpname1 = $('input#orderproductAds1ProductName').val();
                    var adprice1 = $('input#orderproductAds1CurrentPrice').val();

                    $('div.productpanel input#productNumber').val(adpnum1);
                    $('div.productpanel input#productName').val(adpname1);
                    $('div.productpanel input#productCurrentPrice').val(adprice1);

                    $('button.btnProductOrderFormLaunch:first').click();
                }
                else if (endAdvert != null && mainVideo != null && mainVideo.ended)
                {
                    //modal for ordering first advert product
                    var adpnum2 = $('input#orderproductAds2ProductNumber').val();
                    var adpname2 = $('input#orderproductAds2ProductName').val();
                    var adprice2 = $('input#orderproductAds2CurrentPrice').val();

                    $('div.productpanel input#productNumber').val(adpnum2);
                    $('div.productpanel input#productName').val(adpname2);
                    $('div.productpanel input#productCurrentPrice').val(adprice2);

                    if ($('button.btnProductOrderFormLaunch:nth-child(1)').length)
                        $('button.btnProductOrderFormLaunch:nth-child(2)').click();
                    else
                        $('button.btnProductOrderFormLaunch:first').click();
                }*/

                //modal launch
                if (startAdvert != null && !startAdvert.ended)
                {
                    //modal for ordering first advert product
                    var adpnum = $('input#orderproductAds1ProductNumber').val();
                    var adpname = $('input#orderproductAds1ProductName').val();
                    var adprice = $('input#orderproductAds1CurrentPrice').val();

                    $('input#txtProductNumber').val(adpnum);
                    $('span#ordered-item-product-name').text(adpname);
                    $('span#ordered-item-price').text('Price: N' + adprice);
                }
                else if (endAdvert != null && mainVideo != null && mainVideo.ended)
                {
                    //modal for ordering first advert product
                    var adpnum1 = $('input#orderproductAds2ProductNumber').val();
                    var adpname1 = $('input#orderproductAds2ProductName').val();
                    var adprice1 = $('input#orderproductAds2CurrentPrice').val();

                    $('input#txtProductNumber').val(adpnum1);
                    $('span#ordered-item-product-name').text(adpname1);
                    $('span#ordered-item-price').text('Price: N' + adprice1);
                }

                $('div#vp-mini-ad-actionbtn').click();
            }
        });
        /**********THE****END*******************/
        

        //hide and show adverts
        var videoplayers = $('div#video-player-embed video');
        var numOfVideoPlayers = videoplayers.length;
        var supposedCurrentTime = 0; //stop seek on adverts

        if (numOfVideoPlayers == 3)
        {
            //hide main
            startAdvert = videoplayers.get(0);
            mainVideo = videoplayers.get(1);
            endAdvert = videoplayers.get(2);

            $(mainVideo).addClass('hidden');
            $(endAdvert).addClass('hidden');

            $(startAdvert).add(endAdvert).add(mainVideo)
            .attr('controlsList','nodownload'); //show no download

            $(startAdvert).add(endAdvert)
            .on('timeupdate', function() {
                if ( !this.seeking) {
                      supposedCurrentTime = this.currentTime;
                      var date = new Date(0, 0, 0, 0, 0, Math.floor(this.duration - this.currentTime));
                      var hours = date.getHours();
                      hours = hours < 10 ? '0' + hours : hours;
                      var mins = date.getMinutes();
                      mins = mins < 10 ? '0' + mins : mins;
                      var secs = date.getSeconds();
                      secs = secs < 10 ? '0' + secs : secs;

                      $('div#advert-countdown').text(hours + ':' + mins + ':' + secs);
                }
              })
            .on('seeking', function() {
                // guard agains infinite recursion:
                // user seeks, seeking is fired, currentTime is modified, seeking is fired, current time is modified, ....
                var delta = this.currentTime - supposedCurrentTime;
                if (Math.abs(delta) > 0.01) {
                    console.log("Seeking is disabled");
                    this.currentTime = supposedCurrentTime;
                }
            });
            //.removeAttr('controls');

            $(startAdvert).attr('autoplay', 'on');
            if (!is_desktop_viewport)
            {
                $(startAdvert).attr('muted', 'muted'); //mobile requires muting for autoplay
                startAdvert.muted = true;
            }

            startAdvert.autoplay = true;
            startAdvert.play();

            $('div.order-ads-product-now').removeClass('hidden');

            $(startAdvert).on('ended', function () {
                //$('a#orderVideoAdProduct').addClass('hidden');
                supposedCurrentTime = 0;

                $('div.order-ads-product-now').addClass('hidden');
                
                setTimeout(function () {
                    //alert("Starting main video");
                    $(startAdvert).remove();

                    $(mainVideo).removeClass('hidden')
                    .on('ended', function () {
                        $(mainVideo).remove();

                        setTimeout(function () {
                            $(mainVideo).addClass('hidden');
                            $(endAdvert).removeClass('hidden');
                            
                            $(endAdvert).attr('autoplay', 'on').attr('muted', 'muted');
                            endAdvert.autoplay = true;
                            endAdvert.muted = true;
                            endAdvert.play();

                            $('div.order-ads-product-now').removeClass('hidden');

                        }, 1000);
                    })[0].play();

                }, 1000);
            });
        }
        else
        {
            //only main video
            videoplayers.attr('controlsList','nodownload')
            .get(0).play();
        }

        //click event for video ad play
        $('div.productvideopanel').click(function () {
            var alink = $(this).siblings('div.productdetailspanel').children('input#watch-link').val();
            window.location.href = alink;
        });

        var finishedPlay = false;
        //show advert
        if ($('div#products-adverts-container').length)
        {
            $('div#products-adverts-container').removeClass('hidden');
            setTimeout(function(){
                $('button#btnCloseAdvert').removeClass('hidden');
                $('button#btnCloseAdvert').click(function (){
                    $('div#products-adverts-container').addClass("hidden");
                    $('div#video-player-embed').removeClass("hidden");

                    if (!finishedPlay) {
                        setTimeout(function (){
                            document.getElementsByTagName('video').item(0).play();
                        }, 1000);
                    }
                });

            }, 5000);

            $('video').on('ended', function (){
                setTimeout(function () {
                    finishedPlay = true;
                    $('div#products-adverts-container').removeClass("hidden");
                    $('div#video-player-embed').addClass("hidden");
                }, 2000);
            });
        }
        else
        {
            $('div#video-player-embed').removeClass("hidden");
        }

        //adjust advert dimensions
        var main_ads_panel = $('div#main-advert');
        main_ads_panel.width($('div.advertLefttCol').width());
        main_ads_panel.height($(window).height() * 0.85);

        var other_ads_panel = $('div.other-advert');
        other_ads_panel.width($('div#advertLefttCol').width());
        other_ads_panel.height($(window).height() / 5);

        //time hide of mobile menu
        if ($('div#desktop-related-videos-view').css('display') == 'none')
        {
            $('div.mobile-view-menus-overlay').removeClass('hidden')
            var mobile_menu_fade_time_handle = setTimeout(function () {
                mobile_menu_fade_time_handle = null;
                $('div.mobile-view-menus-overlay').animate({'opacity': '0'}, 400, function () {
                    $(this).css({opacity: 1}).addClass('hidden');
                });
            }, 5000);

            //click of player
            $('div#video-player-embed').add(mainVideo).click(function () {
                if (mainVideo.started)
                {
                    if (mainVideo.playing) 
                        mainVideo.pause();
                    else
                        mainVideo.play();
                }

                if (mobile_menu_fade_time_handle != null)
                {
                    clearTimeout(mobile_menu_fade_time_handle);
                    mobile_menu_fade_time_handle = null;
                }

                //show
                $('div.mobile-view-menus-overlay').removeClass('hidden');
                mobile_menu_fade_time_handle = setTimeout(function () {
                    mobile_menu_fade_time_handle = null;
                    $('div.mobile-view-menus-overlay').animate({'opacity': '0'}, 400, function () {
                        $(this).css({opacity: 1}).addClass('hidden');
                    });
                }, 5000);
            });
        }
    }
    

    //video upload script
    if ($('form#formUploadVideo').length)
    {
        $('label#lblSaveAsAdsVideo').data('count', 0)
        .click(function () {
            var checkboxLabelClickCount = $(this).data('count');
            $(this).data('count', ++checkboxLabelClickCount);
            if ($(this).data('count') % 2)
                $('#fsTxtProductPrice').removeClass('hidden');
            else
                $('#fsTxtProductPrice').addClass('hidden');
        });

        $('button#btnSubmitVideoUpload').click(function (){
            //do something
            var title = $.trim($('input#txtVideoTitle').val());
            var category = $('select#cbCategory').val();
            var fileloaded = $('input#fileVideoSourceFile').val();

            if ($('input#chkSaveAsAdsVideo').get(0).checked)
            {
                if ( isNaN( parseFloat( $('input#txtProductPrice').val() )))
                {
                    alert('Please enter the price for the product in the video advert');
                    return;
                }
            }

            if (title.length && category != '-1' && fileloaded.length)
            {
                if (confirm("Do you want to upload " + fileloaded + "?"))
                    $('form#formUploadVideo').submit();
            }
            else
                alert("Please enter category, title, and load a file to continue!");
        });
    }

    //video list script
    if ($('form#formDeleteVideo').length)
    {
        //delete action
        $('button.btnDeleteVideoUpload').click(function () {
            if (confirm('Do you want to delete this video?'))
            {
                var vidid = $(this).siblings('input[type=hidden]').val();
                if (vidid.length)
                {
                    $('input#txthvideoId').val(vidid);
                    $('form#formDeleteVideo').submit();                  
                }
            }
        });

        //encode action
        $('a.anc-request-encode').click(function(e){
            e.preventDefault();
            if (confirm('Do you want to encode this video?'))
            {
                window.location.href = $(this).attr('href');
            }
        })
    }

    if ($('form#formEditVideo').length)
    {
        $('label#lblSaveAsAdsVideo').data('count', 0)
        .click(function () {
            var checkboxLabelClickCount = $(this).data('count');
            $(this).data('count', ++checkboxLabelClickCount);
            if ($(this).data('count') % 2)
                $('#fsTxtProductPrice').removeClass('hidden');
            else
                $('#fsTxtProductPrice').addClass('hidden');
        });

        $('button#btnSubmitEditVideoUpload').click(function (){
            //do something
            var title = $.trim($('input#txtVideoTitle').val());
            var category = $('select#cbCategory').val();
            var fileloaded = $('input#fileVideoSourceFile').val();
            var video_appid = $('input#video_appid').val();

            if ($('input#chkSaveAsAdsVideo').get(0).checked)
            {
                if ( isNaN( parseFloat( $('input#txtProductPrice').val() )))
                {
                    alert('Please enter the price for the product in the video advert');
                    return;
                }
            }

            if (title.length && category != '-1' && video_appid.length)
            {
                if (confirm("Do you want to update changes?"))
                    $('form#formEditVideo').submit();
            }
            else
                alert("Please enter category, title, and load a file to continue!");
        });
    }

    //create category
    if ($('form#formCreateCategory').length)
    {
        $('button#btnSubmitNewCategory').click(function (){
            var title = $.trim($('input#txtCategoryTitle').val());
            var description = $.trim($('textarea#txtDescription').val());

            if (title.length == 0)
            {
                alert("Please enter title for category!");
                return;
            }

            if (description.length == 0 && !confirm('You have not entered a description for this category. Do you want to proceed without it?'))
                return;

            if (confirm('Do you want to create this category(' + title + ')?'))
                $('form#formCreateCategory').submit();
        });
    }

    //category list script
    if ($('table#video-cateory-table').length)
    {
        //delete action
        $('button.btnDeleteCategory').click(function () {
            if (confirm('Do you want to delete this category?'))
            {
                var catid = $(this).siblings('input[type=hidden]').val();
                if (catid.length)
                {
                    $('input#txthcategoryId').val(catid);
                    $('form#formDeleteCategory').submit();                  
                }
            }
        });

        //edit action
        $('button.btnEditCategory').click(function (){
            var catid = $(this).siblings('input[type=hidden]').val();
            if (catid.length)
                window.location.href = 'edit-category/' + catid;
        });
    }

    //category edit script
    if ($('form#formEditCategory').length)
    {
        $('button#btnSubmitEditCategory').click(function (){
            var title = $.trim($('input#txtCategoryTitle').val());
            var description = $.trim($('textarea#txtDescription').val());

            if (title.length == 0)
            {
                alert("Please enter title for category!");
                return;
            }

            if (description.length == 0 && !confirm('You have not entered a description for this category. Do you want to proceed without it?'))
                return;

            if (confirm('Do you want to make changes this category?'))
                $('form#formEditCategory').submit();
        });
    }

    //create product script
    if ($('form#formCreateProduct').length)
    {
        $('button#btnSubmitNewProduct').click(function (){
            var prod_name = $.trim($('input#txtProductName').val());
            var prod_banner = $('input#fileProductImage').val();
            var prod_description = $.trim($('textarea#txtDescription').val());
            var prod_price = $.trim($('input#txtProductPrice').val());

            if (prod_name.length < 5)
            {
                alert('Please enter the name of the product of at least 5 characters!');
                return;
            }

            if (isNaN(parseFloat(prod_price)) || parseFloat(prod_price) == 0)
            {
                alert('Please enter a proper value for product price!');
                return;
            }

            if (prod_banner.length == 0)
            {
                alert('Please upload a banner file the product!');
                return;
            }

            if (prod_description.length == 0 && !confirm('You have not provided a description for this product. Do you want to proceed without it?'))
                return;

            //upload
            if (confirm("Do you want to create this product(" + prod_name + ")?"))
                $('form#formCreateProduct').submit();
        });
    }

    //product list script
    if ($('table#product-table').length)
    {
        //delete action
        $('button.btnDeleteProduct').click(function () {
            if (confirm('Do you want to delete this product?'))
            {
                var prod_id = $(this).siblings('input[type=hidden]').val();
                if (prod_id.length)
                {
                    $('input#txthproductId').val(prod_id);
                    $('form#formDeleteProduct').submit();                  
                }
            }
        });
    }

    //product edit script
    if ($('form#formEditProduct').length)
    {
        $('button#btnSubmitEditProduct').click(function (){
            var prod_name = $.trim($('input#txtProductName').val());
            var prod_banner = $('input#fileProductImage').val();
            var prod_description = $.trim($('textarea#txtDescription').val());
            var prod_price = $.trim($('input#txtProductPrice').val());

            if (prod_name.length < 5)
            {
                alert('Please enter the name of the product of at least 5 characters!');
                return;
            }

            if (isNaN(parseFloat(prod_price)) || parseFloat(prod_price) == 0)
            {
                alert('Please enter a proper value for product price!');
                return;
            }

            if (prod_description.length == 0 && !confirm('You have not provided a description for this product. Do you want to proceed without it?'))
                return;

            //upload
            if (confirm("Do you want to update this product?"))
                $('form#formEditProduct').submit();
        });
    }
})