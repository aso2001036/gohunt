$(function () {
    $('.accordion').on('click', function () {
        $(this).next().slideToggle();
        //openクラスをつける
        $(this).toggleClass("open");
        //クリックされていないac-parentのopenクラスを取る
        $('.accordion').not(this).removeClass('open');

        // 一つ開くと他は閉じるように
        $('.accordion').not($(this)).next('.box').slideUp();
    });
});