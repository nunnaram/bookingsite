(function ($) {
    $(document).ready(function () {
        $('a[href*="#"]:not([href="#"])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = jQuery(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
        
         $('body').on("change",".vtype input",function(){
               if(this.value == 'private') {
                    $('companyname').show();
                }else{
                    $('companyname').hide();
                }
        })

//        var disabledDates = ["2019-07-10", "2019-07-15", "2019-07-20"]
        // console.log(calendarPrices, 'calendarPrices');
        if( $('#calender').length > 0){
            $('#calender').multiDatesPicker({
                mode: 'daysRange',
                altField: '#bookingdate',
                minDate: '2d',
                firstDay: 1,
                maxDate: new Date(promotion_ends),
                autoselectRange: [0, promotion_nights],
                dayNamesMin: ["zo", "ma", "di", "wo", "do", "vr", "za"],
                beforeShowDay: function (date) {
                    var weekday = date.getDay();
                    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                    //console.log('weekday', weekday, calendarPrices[weekday]);
                    var price = calendarPrices[weekday];
                    if (price) {
                        return [disabledDates.indexOf(string) == -1, "", price];
                    }
                    else {
                        return [disabledDates.indexOf(string) == -1, '', ''];
                    }
                },
                onChangeMonthYear: addCustomInformation,
                onSelect: function(dateText){
                        var seldate = $(this).datepicker('getDate');
                        seldate = seldate.toDateString();
                        seldate = seldate.split(' ');
                        var weekday=new Array();
                            weekday['Mon']="1";
                            weekday['Tue']="2";
                            weekday['Wed']="3";
                            weekday['Thu']="4";
                            weekday['Fri']="5";
                            weekday['Sat']="6";
                            weekday['Sun']="0";
                        var dayOfWeek = weekday[seldate[0]];
                        show_fare(calendarPrices[dayOfWeek]);
                        addCustomInformation();
                    }
            });
        }

        // $("#calender").datepicker({
        //     firstDay: 1,
        //     dayNamesMin: ["zo", "ma", "di", "wo", "do", "vr", "za"],
        //     beforeShowDay: function (date) {
        //         var weekday = date.getDay();
        //         var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        //         //console.log('weekday', weekday, calendarPrices[weekday]);
        //         var price = calendarPrices[weekday];
        //         if (price) {
        //             return [disabledDates.indexOf(string) == -1, "", price];
        //         }
        //         else {
        //             return [disabledDates.indexOf(string) == -1, '', ''];
        //         }
        //     },
        //     onChangeMonthYear: addCustomInformation,
        //     onSelect: addCustomInformation
        // });
        addCustomInformation();
        function addCustomInformation() {
            setTimeout(function () {
                $(".ui-datepicker-calendar td").filter(function () {
                    var price = $(this).attr('title');
                    $(this).find("a").attr('data-price', price);
                });
            }, 0)
        }

        function check_fares(){
            var hb_persons= $("#hb-persons").val();
            var hb_rooms= $("#hb-rooms").val();
            var hb_pid= $("#promotion_id").val();
            $('#calender').multiDatesPicker('destroy');
           jQuery.ajax({
                type: 'POST',
                url: Theme.ajax_url,
                dataType: 'json',
                data: {
                    'action': 'calculate_fares',
                    'hb_persons': hb_persons,
                    'hb_rooms': hb_rooms,
                    'hb_pid': hb_pid,
                },
                success: function (response){
//                    var json = jQuery.parseJSON(data);
//                    console.log(data['calendarPrices']['0w']);
                    var calendarPricesevnt =  response.calendarPrices;
                    $('#calender').multiDatesPicker({
                        mode: 'daysRange',
                        altField: '#bookingdate',
                        minDate: '2d',
                        firstDay: 1,
                        maxDate: new Date(promotion_ends),
                        autoselectRange: [0, promotion_nights],
                        dayNamesMin: ["zo", "ma", "di", "wo", "do", "vr", "za"],
                        beforeShowDay: function (date) {
                            var weekday = date.getDay();
                            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                            var priceweak = "w"+weekday;
//                            console.log(response.calendarPrices);
                            var price = response.calendarPrices[priceweak];
//                            console.log(priceweak);
                            if (price) {
                                return [disabledDates.indexOf(string) == -1, "", price];
                            }
                            else {
                                return [disabledDates.indexOf(string) == -1, '', ''];
                            }
                        },
                        onChangeMonthYear: addCustomInformation,
                        onSelect: function(dateText,obj){
                            console.log(calendarPricesevnt);
                            var seldate = $(this).datepicker('getDate');
                            seldate = seldate.toDateString();
                            seldate = seldate.split(' ');
                            var weekday=new Array();
                                weekday['Mon']="1";
                                weekday['Tue']="2";
                                weekday['Wed']="3";
                                weekday['Thu']="4";
                                weekday['Fri']="5";
                                weekday['Sat']="6";
                                weekday['Sun']="0";
                            var dayOfWeek = weekday[seldate[0]];
                            var priceweek = calendarPricesevnt;
                            show_fare(calendarPricesevnt["w"+dayOfWeek]);
                            addCustomInformation();
                        }
                    });
                    addCustomInformation();
                }
            });
        }
        
        
        function show_fare(price){
            var persons = $("#hb-persons").val();
            var rooms = $("#hb-rooms").val();
            var message= "Totaalprijs gebaseerd op uw reisgezelschap ("+ persons +" volwassenen en "+ rooms +" kamer), excl. toeristenbelasting. U kunt een beschikbare kamer kiezen in de volgende stap.";
            $("#hb_pprice  span").html(price);
            $(".price-box  input").val(price);
            $("#fare_message").html(message);
            return false;
        }
        $(".change-events .change-persons i").click(function(){
            var inputval  =  parseInt($(this).parent().parent().find('input').val());
            if($(this).hasClass('fa-plus-square')){
                $("#hb-persons").val(inputval+1);
            }else{
                if(inputval > 1){
                    $("#hb-persons").val(inputval-1);
                }
            }
            var persons = $("#hb-persons").val();
            cal_rooms(persons);
            check_fares();
        });      
        $(".change-events .change-rooms i").click(function(){
            var inputval  =  parseInt($(this).parent().parent().find('input').val());
            if($(this).hasClass('fa-plus-square')){
                $("#hb-rooms").val(inputval+1);
            }else{
                if(inputval > 1){
                     $("#hb-rooms").val(inputval-1);
                }
            }
            var rooms = $("#hb-rooms").val();
            cal_persons(rooms);
            check_fares();
        });
        
        function cal_rooms(persons){
            var rooms = persons / 2;
            if(rooms >= 2 ){
                var roomsmod = persons % 2;
                if(roomsmod == 0){
                    $("#hb-rooms").val(parseInt(rooms));
                }else{
                    $("#hb-rooms").val(parseInt(rooms+1));
                }
            }else{
                $("#hb-rooms").val(1);
            }
        }      
        function cal_persons(rooms){
            var rooms = rooms*2;
            $("#hb-persons").val(rooms);
        }
    });
})(jQuery);
