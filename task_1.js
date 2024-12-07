function pickPropArray(arr, prop) {
    return arr.map(obj => obj[prop]).filter(value => value !== undefined);
  }
  
  const students = [
    { name: 'Павел', age: 20 },
    { name: 'Иван', age: 20 },
    { name: 'Эдем', age: 20 },
    { name: 'Денис', age: 20 },
    { name: 'Виктория', age: 20 },
    { age: 40 },
  ];
  
  console.log(pickPropArray(students, 'name'));