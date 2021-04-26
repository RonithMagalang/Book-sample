"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = bookinfo;

function bookinfo(selector) {
  $(selector).empty();
  $(selector).append("\n<div class=\"container\">\n<div class=\"col\">\n<div class=\"form-group\">\n            <label for=\"\"></label>\n            <input type=\"text\"\n              class=\"form-control\" name=\"\" id=\"bookcode\" aria-describedby=\"helpId\" placeholder=\"Book code\">\n               <small id=\"helpId\" class=\"form-text text-muted\"></small>\n </div>\n\n <div class=\"form-group\">\n            <label for=\"\"></label>\n            <input type=\"text\"\n              class=\"form-control\" name=\"\" id=\"bookname\" aria-describedby=\"helpId\" placeholder=\"Book Name\">     \n             <small id=\"helpId\" class=\"form-text text-muted\"></small>\n </div>\n <div class=\"form-group\">\n            <label for=\"\"></label>\n            <input type=\"text\"\n              class=\"form-control\" name=\"\" id=\"author\" aria-describedby=\"helpId\" placeholder=\"Author\">\n               <small id=\"helpId\" class=\"form-text text-muted\"></small>       \n </div>\n\n          <button type=\"submit\" id=\"save\" class=\"btn btn-primary mt-4\">save</button>\n        \n</div>\n</div>\n</div>\n\n\n\t");
}