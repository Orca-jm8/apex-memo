function CountDownLength( idn, str, mnum ) {
    document.getElementById(idn).innerHTML = "あと" + (mnum - str.length) + "文字";
 }