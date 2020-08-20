var arr = [], l = document.links;
for(var i=0; i<l.length; i++) {
  arr.push(l[i].href);
}
document.write(arr);
