"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = GetValue;
exports.GetValues = GetValues;

function GetValue(selector) {
  return $(selector).val();
}

function GetValues(selectors) {
  var aL = selectors.length;
  var values = [];
  var i;

  for (i = 0; i < aL; i++) {
    values.push($(selectors[i].split(",", ",", 1)[0]).val());
  }

  return values;
}