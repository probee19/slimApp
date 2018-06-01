    var start = moment();
    var end = moment();

    var start7Days = moment().subtract(6, 'days');
    var start15Days = moment().subtract(14, 'days');
    var start30Days = moment().subtract(29, 'days');
    var toExecute = loadStatForChoosenRange;

    var selectedTest = '';
    var selectedTestName = '';
    var oneCountry = '';
    var selectedCountryName = '';
    var countries = {};
    var selectedCountriesNames = {};

    var selectedUser = '';
    var selectedUserName = '';
    var selectedUserFbID = '';

    var selectedLang = '';

    $('#search_test').select2({
         placeholder: 'Rechercher un test...',
         width: '200px'
    });

    $('#search_country').select2({
         placeholder: 'Rechercher un pays...',
         width: '250px'
    });

    $("#search_lang").select2({
         placeholder: 'Langue...',
         width: '150px'
    });

    $(document).ready(function () {
        $('.select2').each(function () {
            // (this).prop("style","max-width:300px");
        })

        var option = {
          autoUpdateInput: true,
          "startDate": start,
          "endDate": end,
          "maxDate": end,
          "alwaysShowCalendars": true,
          "buttonClasses": "btn btn-xs",
          "opens": "left",
          "locale": {
              "format": "DD/MM/YYYY",
              "applyLabel": "Valider",
              "cancelLabel": "Annuler",
              "customRangeLabel": "Personnalisée"
          },
          ranges: {
             'Aujourd\'hui': [moment(), moment()],
             'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
             'Les 15 derniers jours': [moment().subtract(14, 'days'), moment()],
             'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
             'Ce mois': [moment().startOf('month'), moment().endOf('month')],
             'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
             'Depuis le début': [moment('20170916'), moment()]
          }
        }

        // init daterangepicker
        $('input[name="daterange"]').daterangepicker(option, function(startDate, endDate, label) {
            start = startDate; end = endDate;
            search();
        });
        showHome();

      $("#btn_go").on('click', function () {
          search();
      });

      $('#btn_maj_json_loved_test').on('click', function () {
        UpdateJsonLovedTest();
      });

      $("#btn_maj_json_highlighted_test").on('click', function () {
        UpdateJsonHighlightedTest();
      });
    });

    function UpdateJsonLovedTest () {
      console.log('Début de la mise à jour...');
      console.log('Du '+ start.format('YYYY-MM-DD') + ' au '+ end.format('YYYY-MM-DD'));

      $.ajax({
        //url: 'maj/jsonlovedtests?start=' + start7Days.format('YYYY-MM-DD') + '&end=' + end.format('YYYY-MM-DD'),
        url: 'maj/jsonlovedtests?start=' + start.format('YYYY-MM-DD') + '&end=' + end.format('YYYY-MM-DD'),
        type: 'GET',
        processData: false,
        contentType: false,
        beforeSend: function () {
          loadingOnButton('#btn_maj_json_loved_test');
                // loading(div);
        }
      }).done(function (data) {
        loadingOffButton('#btn_maj_json_loved_test', 'MAJ des fichiers des tests les mieux partagés');
        console.log(data);
      });
    }

    function UpdateJsonHighlightedTest () {
      console.log('Début de la mise à jour...');
      $.ajax({
        url: 'maj/jsonhighlightedtests',
        type: 'GET',
        processData: false,
        contentType: false,
        beforeSend: function () {
          loadingOnButton('#btn_maj_json_highlighted_test');
                // loading(div);
        }
      }).done(function (data) {
        loadingOffButton('#btn_maj_json_highlighted_test', 'MAJ des fichiers des tests mis en avant');
        console.log(data);
      });
    }


    function search () {
        var notEmpty = false;
        // Get selected test
        selectedTest = ''; selectedTestName = '';  selectedCountriesNames = {}; countries = {};
        if($( "#search_test option:selected" ).val() != "" && $( "#search_test option:selected" ).val() != '0'){
            selectedTest = $("#search_test option:selected" ).val();
            selectedTestName = $("#search_test option:selected" ).text();
            notEmpty = true;
        }

        // Get selected countries
        if($('#search_country').val() != null){
            countries = $('#search_country').val();
            jQuery.each( countries, function( i, val ) {
                selectedCountriesNames[val] = $( "#"+val ).text();
            });
            notEmpty = true;
        }

        // Get the language
        if($( "#search_lang option:selected" ).val() != "" && $( "#search_lang option:selected" ).val() != '0'){
          selectedLang = $("#search_lang option:selected" ).val();
        }
        else {
          selectedLang = '';
        }

        if(notEmpty)
            toExecute = loadStatForThisTestForCountries;
        else if(toExecute == loadStatForThisTestForCountries)
            toExecute = loadStatForChoosenRange;
            ////console.log(toExecute);
            //console.log(notEmpty);
        toExecute('#stats_for_one_range',start ,end);
    }

    function setSelect2Test (val = '') {
        // Select2 for tests
        $("#search_test").select2({
             placeholder: 'Rechercher un test ...'
        });
        $("#search_test").val(val).trigger('change');

    }

    function setSelect2Lang(val="") {
        // Select2 for languages
        $("#search_lang").select2({
             placeholder: 'Langue ...'
        });
        $("#search_lang").val(val).trigger('change');
    }

    function setSelect2Country(val="") {
        // Select2 for countrie
        $('#search_country').select2({
             placeholder: 'Rechercher un pays...'
        });
        if(val != "")
            $('#search_country').val([val]).trigger('change');
        else
            $('#search_country').val('').trigger("change");

    }

    function showHome(btn=null) {
        toExecute = loadStatForChoosenRange;
        toExecute('#stats_for_one_range',start ,end);
        if(btn != null){
            $("#menu-content > .active").removeClass("active");
            btn.addClass("active");
        }
    }
    function showForTests(btn=$("#btn_for_tests_stats")) {
        toExecute = loadTopTestForChoosenRange;
        selectedTest = '';
        selectedTestName = '';
        setSelect2Test();
        search();
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }
    function showForContries(btn=$("#btn_for_contries_stats")) {
       // setSelect2Country();
        toExecute = loadTopContriesForChoosenRange;
        toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }
    function showForUsers(btn=$("#btn_for_users_stats")) {
       // setSelect2Country();
        toExecute = loadTopUsersForChoosenRange;
        toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }

    function showStatsForSomeTests(btn=$("#btn_for_some_tests_stats")) {
       // setSelect2Country();
        toExecute = loadStatsForSomeTestsForChoosenRange;
        toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }

    function showStatsForBestTests(btn=$("#btn_for_best_tests_stats")) {
       // setSelect2Country();
        toExecute = loadBestTestForChoosenRange;
        toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }

    function showForOneTest(nameOfOneTest,oneTest,btn=$("#btn_for_tests_stats")) {
        //toExecute = loadStatForThisTest;
        selectedTest = oneTest;
        selectedTestName = nameOfOneTest;
        setSelect2Test(selectedTest);
        search();
        //toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }
    function showForOneCountry(nameOfOneCountry,oneCountry,btn=$("#btn_for_contries_stats")) {
        //toExecute = loadStatForThisCountry;
        selectedCountry = oneCountry;
        selectedCountryName = nameOfOneCountry;
        setSelect2Country(selectedCountry);
        search();
        //toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }

    function showForOneTestForCountries(nameOfOneTest, oneTest, countries, countriesNames, btn=$("#btn_for_tests_stats")) {
        toExecute = loadStatForThisTestForCountries;
        selectedTest = oneTest;
        selectedTestName = nameOfOneTest;

        countries = '';
        selectedCountriesNames = '';

        toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");
        btn.addClass("active");
    }

    function loading(div) {
        $(div).html('<span style="display: block; color: #000; font-size: 14px; margin-top: 20px; margin-bottom:10px;">Chargement en cours ... </span> <img  src="https://creation.funizi.com/src/img/load-stat.gif"/>');
    }

    function loadingOnButton (idButton) {
      $(idButton).html('<img  src="https://creation.funizi.com/src/img/loading_arrow.gif"/> Mise à jour en cours ...');
      $(idButton).prop( "disabled", true );
      //$(idButton).css('-webkit-animation: fa-spin 2s infinite linear; animation: fa-spin 2s infinite linear;');
    }
    function loadingOffButton (idButton, label) {
      $(idButton).html('<i class="fas fa-sync-alt"></i>&nbsp;' + label);
      $(idButton).prop( "disabled", false );
    }


    function showUsersTests(userName, userId, fbId) {
        selectedUser = userId;
        selectedUserName = userName;
        selectedUserName = userName;
        selectedUserFbID = fbId;

        toExecute = loadTestForOneUser;
        toExecute('#stats_for_one_range',start ,end);
        $("#menu-content > .active").removeClass("active");

    }

    function showAfterSelectTest() {
        if($( "#search_test option:selected" ).val() != "")
        showForOneTest($( "#search_test option:selected" ).text(),$( "#search_test option:selected" ).val());
    }

    function showAfterSelectCountry() {
        if($( "#search_country option:selected" ).val() != "" )
        showForOneCountry($( "#search_country option:selected" ).text(),$( "#search_country option:selected" ).val());
    }

    var loadTestForOneUser = function (div, startDate, endDate) {
        $.ajax({
          url: "load/loadTestForUser?lang="+selectedLang+"&fb_id="+selectedUserFbID+"&user="+selectedUser+"&userName="+selectedUserName+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
          type: "GET",
          processData: false,
          contentType: false,
          beforeSend: function(){
                  setSelect2Test();
                  setSelect2Country();
                  //console.log(selectedUser);
                  //console.log(selectedUserName);
                  loading(div);
          }
        }).done(function( data ) {
                start = startDate;
                end = endDate ;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadStatForChoosenRange = function (div, startDate, endDate) {
        $.ajax({
          //url: "load-stats.php?action=loadstatforthisrange&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
          url: "load/loadstatforthisrange?lang="+selectedLang+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
          type: "GET",
          processData: false,
          contentType: false,
          beforeSend: function(){
                  setSelect2Test();
                  setSelect2Country();
                  loading(div);
                  //console.log(selectedLang);
          }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadTopTestForChoosenRange = function (div , startDate, endDate) {
        $.ajax({
        url: "load/loadTopTests?lang="+selectedLang+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function(){
                setSelect2Test();
                loading(div);
        }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadBestTestForChoosenRange = function (div , startDate, endDate) {
        $.ajax({
        url: "load/loadBestTests?lang="+selectedLang+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function () {
                setSelect2Test();
                loading(div);
        }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadStatsForSomeTestsForChoosenRange = function (div , startDate, endDate) {
        $.ajax({
        url: "load/loadStatsForSomeTests?lang="+selectedLang+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function(){
                setSelect2Test();
                loading(div);
        }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadTopContriesForChoosenRange = function (div , startDate, endDate) {
        $.ajax({
        url: "load/loadTopContries?lang="+selectedLang+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function(){
                setSelect2Test();
                loading(div);
        }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadTopUsersForChoosenRange = function (div , startDate, endDate) {
        $.ajax({
        url: "load/loadTopUsers?lang="+selectedLang+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
        type: "GET",
        beforeSend: function(){
                setSelect2Test();
                setSelect2Country();
                loading(div);
        }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadStatForThisTest = function (div, startDate, endDate) {
        $.ajax({
        url: "load/loadStatForThisTest?lang="+selectedLang+"&test="+selectedTest+"&name="+selectedTestName+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function(){
                setSelect2Test(selectedTest);
                loading(div);
        }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }

    var loadStatForThisTestForCountries = function (div, startDate, endDate) {
        //var data = "";

        var  countriess = JSON.stringify(selectedCountriesNames);
        // console.log(countriess);
        // console.log(selectedTestName);
        // console.log(selectedTest);
        // console.log(selectedLang);
        // console.log(startDate.format('YYYY-MM-DD'));
        // console.log(endDate.format('YYYY-MM-DD'));
        $.ajax({
        url: "load/loadStatForThisTestForCountries",
        type: "POST",
            data: {countries : countriess, lang : selectedLang, start : startDate.format('YYYY-MM-DD'), test : selectedTest, name : selectedTestName, end : endDate.format('YYYY-MM-DD'), action :  'loadStatForThisTestForCountries'},
            cache: false,
            beforeSend: function(){
                loading(div);
            }
            }).done(function( msg ) {
                ////console.log(msg);

                start = startDate; end = endDate;
                $(div).html(msg).fadeIn("slow");
        });
    }

    var loadStatForThisCountry = function (div, startDate, endDate) {
        $.ajax({
        url: "load-stats.php?action=loadStatForThisCountry&lang="+selectedLang+"&country="+selectedCountry+"&name="+selectedCountryName+"&start="+startDate.format('YYYY-MM-DD')+"&end="+endDate.format('YYYY-MM-DD'),
        type: "GET",
        processData: false,
        contentType: false,
        beforeSend: function(){
                setSelect2Country(selectedCountry);
                loading(div);
        }
        }).done(function( data ) {
                start = startDate; end = endDate;
                $(div).html(data).fadeIn("slow");
        });
    }
