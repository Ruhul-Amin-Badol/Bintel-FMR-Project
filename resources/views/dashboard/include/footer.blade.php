


<div class="row border-top py-4">
    <div class="col-md-12 mt-5">
        <p class=" text-center text-md-left text-secondary">
            &copy; <a class="text-primary" href="#"></a>Developed.
            by
            <a class="text-danger" style="font-weight:600;" href="#">Department Of IT (Royal)</span></a>
            <p class="py-3 text-center text-muted">Version-3.0 (Updated)</p>
        </p>
    </div>

</div>



    <script>
        $(function() {
            $('#daterange').daterangepicker({
                opens: 'right',
                startDate: moment().subtract(7, 'days'),
                endDate: moment(),
                minDate: moment().subtract(1, 'year'),
                maxDate: moment(),
                showDropdowns: true,
                showWeekNumbers: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                alwaysShowCalendars: true
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>

<script>
    $(document).ready(function() {


        //ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });




    if ($('.datanewAjax').length > 0){


        $('.datanewAjax').DataTable({
            'processing': true,
            'order': [[0, 'desc']],
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': AJAX_URL
            },

        });

    }

        $(document).on("click", '.admin_status', function(event) {
            event.preventDefault();

            var row_id = $(this).attr('data-value');

            //alert(row_id);

            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, disable it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('dash.profile.update.status') }}"
                        , data: {
                            'id': row_id
                            , "_token": "{{ csrf_token() }}"
                        , }
                        , type: 'POST'
                        , dataType: 'json'
                        , success: function(result) {

                            if (result["message"] == "updated") {
                                Swal.fire({
                                    position: 'top-end'
                                    , icon: 'success'
                                    , title: 'Status Updated'
                                    , showConfirmButton: false
                                    , timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        }

                    });

                }
            })

        });

        $("#cat_name").keyup(function() {
            var name = $("#cat_name").val();
            if (!isDoubleByte(name)) {
                $("#cat_slug").val(name.replace(/ /g, "_"));
            } else {

                $("#cat_slug").val(makeid(10));
            }

        });

        function isDoubleByte(str) {
            for (var i = 0, n = str.length; i < n; i++) {
                if (str.charCodeAt(i) > 255) {
                    return true;
                }
            }
            return false;
        }

        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }


        $(document).on("click", '.delete-btn-group', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?"
                , text: "You won't be able to revert this!"
                , type: "warning"
                , showCancelButton: !0
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Yes, delete it!"
                , confirmButtonClass: "btn btn-primary"
                , cancelButtonClass: "btn btn-danger ml-1"
                , buttonsStyling: !1
            }).then(function(t) {
                if (t.isConfirmed) {
                    var url = get_checked();
                    window.location.href = href + "?token=" + url;
                }
            })
        })



    });

    function get_checked() {
        var selected = [];
        $('input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
                var num = $(this).attr('data-value');
                if (num != '0')
                    selected.push($(this).attr('data-value'));
            }
        });
        var url = (btoa(JSON.stringify(selected)));
        return url;

    }

    $("[title='print']").click(function() {
        var pageTitle = 'Print Table'
            , stylesheet = '{{asset("resources/assets/css/bootstrap.min.css")}}'
            , stylesheet2 = '{{asset("resources/assets/css/style.css")}}'
            , win = window.open('', 'Print', 'width=1000,height=1000');
        win.document.write('<html><head><title>' + pageTitle + '</title>' +
            '<link rel="stylesheet" href="' + stylesheet + '">' +
            '<link rel="stylesheet" href="' + stylesheet2 + '">' +
            '</head><body>' + $('.table')[0].outerHTML + '</body></html>');
        win.document.close();
        win.print();
        win.close();
        return false;
    });


    $("[title='excel']").click(function() {
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: `export.xlsx`, // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });
    });

    // active nav menu
    $(".activex").closest('ul').css('display','block');
$(document).ready(function() {
    $('.select2').select2();
});

</script>


