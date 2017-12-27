/*wrong approach*/
for (var i=1; i<=5; ++i) {
    setTimeout(() => console.log(i), 1000);
}

/*correct approach*/
function runSetTimeout(i){

    setTimeout(() =>
    {if(i <= 5) {
        console.log(i);
        i++;
        return runSetTimeout(i);
    }}, 1000);

}
