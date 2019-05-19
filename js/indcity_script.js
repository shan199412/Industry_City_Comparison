(function ($) {
    $(document).ready(function () {

        var citylist = [];


        // When drop down changed
        // $('#city').on('change', function () {
        //     $('input:checkbox').prop('checked', false);
        //     citylist = [];
        //     $('.svg1').hide();
        //     $('.alert1').hide();
        //     $('.diagram_title').hide();
        //     $('.result').hide();
        //
        //
        //     if ($('#city').val() !== "0") {
        //         // Reset checkbox
        //         $('#checkbox').children().show();
        //         // Hide the selected city from checkbox based on id
        //         $('#checkbox').children('#' + $('#city').val()).hide();
        //
        //         // Show section3
        //         $('.section3').fadeIn()
        //
        //         // auto scroll down to section3
        //         $('html, body').animate({
        //             scrollTop: $("div.section3").offset().top
        //         }, 1000)
        //
        //     } else {
        //         $('.result').hide()
        //         $('.section3').hide()
        //         $('.diagram_title').hide()
        //         // reset checkbox
        //     }
        // });

        // Limit number of click in checkbox to 3
        $('input:checkbox').on('change', function () {
            $('.alert1').hide()
            // $('.result').hide()
            $('.svg1').hide()
            $('.diagram_title').hide()

            if ($('input:checkbox:checked').length > 4) {
                $(this).prop('checked', false)
            }
        });

        // var citysummary = {
        //     "Ballarat": $('.citys1').html(),
        //     "Greater Bendigo": $('.citys2').html(),
        //     "Greater Geelong": $('.citys3').html(),
        //     "Greater Shepparton": $('.citys4').html(),
        //     "Horsham": $('.citys5').html(),
        //     "Latrobe": $('.citys6').html(),
        //     "Mildura": $('.citys7').html(),
        //     "Wangaratta": $('.citys8').html(),
        //     "Warrnambool": $('.citys9').html(),
        //     "Wodonga": $('.citys10').html()
        // }
        //
        // var tenCities = ["", "Ballarat",
        //     "Greater Bendigo",
        //     "Greater Geelong",
        //     "Greater Shepparton",
        //     "Horsham",
        //     "Latrobe",
        //     "Mildura",
        //     "Wangaratta",
        //     "Warrnambool",
        //     "Wodonga"]


        $('.submit_button').on('click', function () {

            // console.log(citysummary['Ballarat'])

            citylist = []
            // 1. get city from dropdown and append city list
            // var ct1 = $('#city').val();
            // citylist.push(ct1);
            // 2. get cities from checkbox list

            $("input:checkbox:checked").each(function () {
                citylist.push($(this).attr('id'));
            });
            if (citylist.length === 1 || citylist.length === 0) {
                $('.alert1').show()
            } else {

                // $('.result').empty();
                // citylist.forEach(function (id) {
                //     $('.result').append(citysummary[tenCities[id]])
                // })
                // $('.result').fadeIn();

                $('.diagram_title').fadeIn();


                firstGraph(citylist);
                $('.svg1').fadeIn()
            }


            $('html, body').animate({
                scrollTop: $("div.diagram_title").offset().top
            }, 1000)
        })

    })
})(jQuery);