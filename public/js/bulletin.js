$(function () {
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id');
    $('.category_num' + category_id).slideToggle();
  });

  $(document).on('click', '.like_btn', function (e) {
    //↓ボタンが押されてもリロードされたり、他の画面に推移するのを防ぐ
    e.preventDefault();
    $(this).addClass('un_like_btn');
    $(this).removeClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/like/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(res.likes_count);
    });

    //   .done(function (res) {
    //   console.log(res);
    //   $('.like_counts' + post_id).text(countInt + 1);
    // }).fail(function (res) {
    //   console.log('fail');
    // });
  });

  $(document).on('click', '.un_like_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_like_btn text-danger'); // text-dangerを外すことで黒に戻す
    $(this).addClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unlike/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(res.likes_count);
    });
    //   .done(function (res) {
    //   $('.like_counts' + post_id).text(countInt - 1);
    // }).fail(function () {

    // });
  });
  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var post_title = $(this).attr('post_title');
    var post_body = $(this).attr('post_body');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-title input').val(post_title);
    $('.modal-inner-body textarea').text(post_body);
    $('.edit-modal-hidden').val(post_id);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
  // 予約キャンセルモーダル
  $('.cancel-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var setting_reserve = $(this).attr('setting_reserve');
    var setting_part = $(this).attr('setting_part');
    var reserveId = $(this).data('id');
    $('.modal-reserve-date').text('予約日: ' + setting_reserve);
    var partLabel = '';
    if (setting_part == 1) {
      partLabel = 'リモ1部';
    } else if (setting_part == 2) {
      partLabel = 'リモ2部';
    } else if (setting_part == 3) {
      partLabel = 'リモ3部';
    }
    $('.modal-reserve-part').text('時間: ' + partLabel);
    // $('.cancel-reserve-id').val(reserveId);
    // $('.cancel-reserve-date').val(setting_reserve);
    $('.cancel-modal-hidden').val(reserveId);
    return false;
  });
  $('.cancel-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
  });
});

// 投稿一覧画面のカテゴリーでの絞り込み
$(function () {
  $('.category_toggle').click(function () {
    // 自分の次の .category_conditions_inner を開閉
    $(this).toggleClass('active');
    $(this).next('.category_conditions_inner').slideToggle();

    // 他のカテゴリを閉じたい場合は以下を追加（オプション）
    $('.category_toggle').not(this).removeClass('active');
    $('.category_toggle').not(this).next('.category_conditions_inner').slideUp();
  });
});
