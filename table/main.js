let data = [
    {
        'name' : 'Milan',
        'lastname' : 'Panic',
        'birthday' : 1988 
    },
    {
        'name' : 'Milanka',
        'lastname' : 'Panic',
        'birthday' : 1958 
    },
    {
        'name' : 'Milic',
        'lastname' : 'Panic',
        'birthday' : 1953 
    },
    {
        'name' : 'Jelena',
        'lastname' : 'Panic',
        'birthday' : 1983 
    }
];

data.forEach(printFunct)

function printFunct(item, index){
    console.log(item);
    let html = `<div><p>First name: ${item.name}</p><p>Last name: ${item.lastname}</p><p>Birthday year: ${item.birthday}</p></div><br>`;
    document.getElementById("demo").innerHTML += html;
}