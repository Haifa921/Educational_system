$(document).ready(function() {
    const high_school_average = document.querySelector('#high_school_average');
    const mark = document.querySelector('#mark');

    $('#high_school_type').change(function() {
        getMarkAverage(mark);
        checkMark(mark);
    });

    $('#mark').change(function() {
        checkMark(mark);
        getMarkAverage(mark);
    });

    function checkMark(mark) {

        const mark_value = $(mark).val();
        const high_school_type = document.querySelector('#high_school_type').value;

        if (mark) {
            $.ajax({
                url: checkMarkUrl, // Adjust this route for different desires if necessary
                method: "GET",
                data: {
                    high_school_type: high_school_type,
                    mark: mark_value
                },
                success: function(markResult) {
                    if (markResult == '0') {
                        alert('قيمة المعدل خاطئ أكبر من الحد الأعلى أو أدنى من الحد الأدنى');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }
    }

    function getMarkAverage(mark, average) {

        const mark_value = $(mark).val();
        const high_school_type_value = document.querySelector('#high_school_type').value;

       /// alert(high_school_type_value)
         if (mark) {
            $.ajax({
                url: markPercentageUrl, // Adjust this route for different desires if necessary
                method: "GET",
                data: {
                    high_school_type: high_school_type_value,
                    mark: mark_value
                },
                success: function(markPercentage) {
                    high_school_average.value = markPercentage;
                },
            });
        }
    }
});
