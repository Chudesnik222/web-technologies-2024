class Pizza {
  static PIZZA_TYPES = {
      "Маргарита": { price: 500, calories: 300 },
      "Пепперони": { price: 800, calories: 400 },
      "Баварская": { price: 700, calories: 450 },
  };

  static SIZE_TYPES = {
      "Большая": { price: 200, calories: 200 },
      "Маленькая": { price: 100, calories: 100 },
  };

  static TOPPINGS = {
      "сливочная моцарелла": { price: 50, calories: 20 },
      "сырный борт": { price_small: 150, price_large: 300, calories: 50 },
      "чедер и пармезан": { price_small: 150, price_large: 300, calories: 50 },
  };

constructor() {
      this.pizzaType = null;
      this.size = null;
      this.toppings = [];
}

addTopping(topping) {
      if (!this.toppings.includes(topping)) this.toppings.push(topping);
      else this.toppings.splice(this.toppings.indexOf(topping), 1);
      updateButton();
}

calculatePrice() {
      const basePrice = Pizza.PIZZA_TYPES[this.pizzaType]?.price || 0 ;
      const sizePrice = Pizza.SIZE_TYPES[this.size]?.price || 0 ;

const toppingsPrice = this.toppings.reduce((total, topping) => {
          const toppingData = Pizza.TOPPINGS[topping];
          return total + (this.size === "Маленькая"
              ? toppingData.price_small || toppingData.price
              : toppingData.price_large || toppingData.price);
}, 0 );

return basePrice + sizePrice + toppingsPrice;

}

calculateCalories() {
    const baseCalories = Pizza.PIZZA_TYPES[this.pizzaType]?.calories || 0 ;

    const sizeCalories = Pizza.SIZE_TYPES[this.size]?.calories || 0 ;

    const toppingsCalories = this.toppings.reduce((total, topping) => total + Pizza.TOPPINGS[topping].calories, 0);

    return baseCalories + sizeCalories + toppingsCalories;

}
}

const pizza = new Pizza();

document.querySelectorAll('.pizza-item').forEach(item => {
item.addEventListener('click', () => {
document.querySelectorAll('.pizza-item').forEach(p => p.classList.remove('selected'));
item.classList.add('selected');
pizza.pizzaType = item.dataset.type;

updateButton();
});
});

document.querySelector('input[name=size][value="Маленькая"]').checked = true;
pizza.size = "Маленькая";

document.querySelectorAll('input[name=size]').forEach(radio => {
radio.addEventListener('change', () => {
pizza.size = radio.value;

document.querySelectorAll('.size-option').forEach(option => option.classList.remove('selected'));
radio.parentElement.classList.add('selected');

updateButton();
});
});

document.querySelectorAll('.topping-item').forEach(item => {
item.addEventListener('click', () => {
item.classList.toggle('selected');
pizza.addTopping(item.dataset.topping);

updateButton();
});
});

function updateButton() {
    const totalPrice = pizza.calculatePrice();
    const totalCalories = pizza.calculateCalories();

    document.getElementById('price').innerText = totalPrice || '0';
    document.getElementById('calories').innerText = totalCalories || '0';
}
