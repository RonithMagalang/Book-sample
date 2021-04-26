import bookinfo from "./bookinfo.js";
import { GetValues } from "./reusable_functions.js";
$(document).ready(function () {
  bookinfo("#bookinfo");
  $("#save").click(function (e) {
    e.preventDefault();

    let bookdata = GetValues(["#bookcode", "#bookname", "#author"]);

    $.ajax({
      method: "POST",
      url: "./saveinfo.php",
      data: {
        saveinfo: "",
        bookcode: bookdata[0],
        bookname: bookdata[1],
        author: bookdata[2],
      },
      success: function (response) {
        let result = JSON.parse(response);
        if (result.code == 200) {
          swal(
            "Successfuly Saved",
            "Book code : " +
              result.bookcode +
              "\nTitle : " +
              result.bookname +
              "\nAuthor:" +
              result.author
          );
        } else if (result.code == 400) {
          swal("Warning!", "Bad request : CODE 400", "warning");
        }
      },
    });
  });
});
