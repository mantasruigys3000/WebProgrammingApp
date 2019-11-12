var description=stringChanger("123456789123456789");
var maxStringLength = 27;

//if the string is too big make it 3 lines big and cut the rest of it to fit in the card
if (originalString.length>=maxStringLength)
{
    for(i=maxStringLength;i<=originalString.length;i++)
    {
        var newString= originalString.substr(0,maxStringLength)+"..";
    }
}
//if the string is too small add white spaces to make the card the same height
else if(originalString.length<=maxStringLength)
{
    var newString= originalString;
    newString= newString+ " ".repeat(maxStringLength-originalString.length);
}

