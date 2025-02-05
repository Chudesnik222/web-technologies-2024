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

  constructor(pizzaType) {
      this.pizzaType = pizzaType || null; // Тип пиццы
      this.size = null; // Размер
      this.toppings = []; // Добавки
  }

  addTopping(topping) {
      if (!this.toppings.includes(topping)) this.toppings.push(topping);
      else this.toppings.splice(this.toppings.indexOf(topping), 1);
  }

  calculatePrice() {
      const basePrice = Pizza.PIZZA_TYPES[this.pizzaType].price || 0;
      const sizePrice = Pizza.SIZE_TYPES[this.size]?.price || 0;

      const toppingsPrice = this.toppings.reduce((total, topping) => {
          const toppingData = Pizza.TOPPINGS[topping];
          return total + (this.size === "Маленькая"
              ? toppingData.price_small || toppingData.price
              : toppingData.price_large || toppingData.price);
      }, 0);

      return basePrice + sizePrice + toppingsPrice;
  }

  calculateCalories() {
      const baseCalories = Pizza.PIZZA_TYPES[this.pizzaType]?.calories || 0;
      const sizeCalories = Pizza.SIZE_TYPES[this.size]?.calories || 0;

      const toppingsCalories = this.toppings.reduce((total, topping) => total + Pizza.TOPPINGS[topping].calories, 0);

      return baseCalories + sizeCalories + toppingsCalories;
  }
}

// Логика выбора пиццы
const pizzaImages = document.querySelectorAll('.pizza-image');
const pizza = new Pizza();

pizzaImages.forEach(image => {
    image.addEventListener('click', () => {
        pizza.pizzaType = image.dataset.type;

        // Показываем выбор размера
        document.getElementById('sizeDiv').classList.remove('hidden');
        document.getElementById('toppingsDiv').classList.add('hidden');
        document.getElementById('calculateBtn').classList.add('hidden');
        pizza.size = null; // Сбрасываем размер
        pizza.toppings = []; // Сбрасываем добавки
        updateButton();
    });
});

// Логика выбора размера
document.querySelectorAll('input[name=size]').forEach(radio => {
    radio.addEventListener('change', () => {
        pizza.size = radio.value;

        // Показываем добавки
        document.getElementById('toppingsDiv').classList.remove('hidden');
        updateButton();
    });
});

// Логика выбора добавок
document.querySelectorAll('.topping-item img').forEach(img => {
    img.addEventListener('click', () => {
        const toppingName = img.alt.toLowerCase();
        pizza.addTopping(toppingName);

        img.classList.toggle('selected'); // Подсветка выбранной добавки
        updateButton();
    });
});

// Обновление кнопки с ценой и калориями
function updateButton() {
    const totalPrice = pizza.calculatePrice();
    const totalCalories = pizza.calculateCalories();

    document.getElementById('price').innerText = totalPrice || '0';
    document.getElementById('calories').innerText = totalCalories || '0';

    if (pizza.size && pizza.pizzaType) {
        document.getElementById('calculateBtn').classList.remove('hidden');
    }
}
