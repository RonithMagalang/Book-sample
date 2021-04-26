export default function GetValue(selector) {
  return $(selector).val();
}
export function GetValues(selectors) {
  let aL = selectors.length;
  let values = [];
  let i;
  for (i = 0; i < aL; i++) {
    values.push($(selectors[i].split(",", ",", 1)[0]).val());
  }
  return values;
}
