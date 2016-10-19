/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Author: Matthias Seghers                                        *
 *                                                                 *
 * Created: 02/05/2016                                             *
 * Modified: 23/07/2016                                            *
 *                                                                 *
 * REQUIRES BOOTBOX AND JQUERY TO WORK                             *
 *                                                                 *
 * Various javascript functions to enhance workings of the site.   *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/** * * * * * * * *
 * Event handlers *
 * * * * * * * * **/

$('a.SortFilter').click(function () {
    var newQuery = $(this).attr('href');
    window.location.href = generateQuerystring(newQuery);
    return false;
});
$('a.clearfilter').click(function () {
    clearFilter();

    return false;
});

$('form.delete').submit(function (e) {
    var currentForm = this;
    e.preventDefault();
    bootbox.confirm("Ben je zeker dat je dit item wil verwijderen?", function (result) {
        if (result) {
            currentForm.submit();
        }
    });
});

/** * * * * * *
 * Functions  *
 * * * * * * **/

/**
 * Generate a Querystring given a new query.
 * @param {SQL} newQuery
 * @export
 */
function generateQuerystring(query) {
    var url = window.location.href;

    if (url.indexOf('?') == -1) {
        //add new querystring
        url += "?" + query;
    } else {
        //querystring already there
        var param = query.split('=')[0];

        //RegExp aanmaken
        var reParam = new RegExp(param + "=", "g");

        if (url.search(reParam) == -1) {
            url += "&" + query;
        } else {
            //param already in querystring, change value instead of add.
            //var reQuery = new RegExp("thirdparam=(.*?)(&|$)");
            var reQuery = new RegExp(param + "=(.*?)(&|$)");
            var reLast = new RegExp(param + "=(.*?)&");

            //check if query will have last position (no need for & when last!!)
            if (reLast.exec(url)) {
                url = url.replace(reQuery, query + "&");
            } else {
                url = url.replace(reQuery, query);
            }
            ;
        }
    }

    return url;
}

function clearFilter() {
    var curUrl = window.location.href;
    var querystring = curUrl.substr(curUrl.indexOf('?') + 1);
    var queries = querystring.split('&');
    var newUrl;

    if (curUrl.indexOf("filter=") != -1) {
        for (var i = 0; i < queries.length; i++) {
            if (queries[i].split('=')[0] == "filter") {

                if (curUrl.indexOf('&filter') != -1) {
                    newUrl = curUrl.replace('&' + queries[i], '');
                }
                else if (curUrl.indexOf('?filter') != -1) {
                    if (curUrl.indexOf('?' + queries[i] + '&') != -1) {
                        newUrl = curUrl.replace('?' + queries[i] + '&', '?');
                    }
                    else {
                        newUrl = curUrl.replace('?' + queries[i], '');
                    }
                }
            }
        }
        window.location.href = newUrl;
    }
    else {
        window.location.href = curUrl;
    }
}
