"use strict";

var _bookinfo = _interopRequireDefault(require("./bookinfo.js"));

var _reusable_functions = require("./reusable_functions.js");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

$(document).ready(function () {
  (0, _bookinfo["default"])("#bookinfo");
  $("#save").click(function (e) {
    e.preventDefault();
    var bookdata = (0, _reusable_functions.GetValues)(["#bookcode", "#bookname", "#author"]);
    $.ajax({
      method: "POST",
      url: "./saveinfo.php",
      data: {
        saveinfo: "",
        bookcode: bookdata[0],
        bookname: bookdata[1],
        author: bookdata[2]
      },
      success: function success(response) {
        var result = JSON.parse(response);

        if (result.code == 200) {
          swal("Successfuly Saved", "Book code : " + result.bookcode + "\nTitle : " + result.bookname + "\nAuthor:" + result.author);
        } else if (result.code == 400) {
          swal("Warning!", "Bad request : CODE 400", "warning");
        }
      }
    });
  });
});