-- Create database
CREATE DATABASE IF NOT EXISTS brewngo;
USE brewngo;

-- Create products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price_mp DECIMAL(5,2) NOT NULL,
    price_np DECIMAL(5,2) NOT NULL,
    image VARCHAR(255),
    description TEXT
);

-- Insert sample products
INSERT INTO products (name, category, price_mp, price_np, image, description) VALUES

-- Basic Brew
('Americano', 'Basic Brew', 8.90, 10.90, 'styles/images/No_image.jpg', 'Chilled Espresso Poured Over Cold Water and Ice for a Bold Flavor.'),
('Latte', 'Basic Brew', 10.90, 12.90, 'styles/images/Latte.jpg', 'Espresso Combined with Cold Milk and Ice for a Smooth Sip.'),
('Cappuccino', 'Basic Brew', 11.90, 13.90, 'styles/images/Cappuccino.jpg', 'Classic Blend of Rich Espresso, with Cold Milk and a Light Foamy Top.'),
('Aerocano', 'Basic Brew', 10.90, 12.90, 'styles/images/Aerocano.jpg', 'Made by Steaming Espresso, Ice and Icy Cold Water to Create a Bold and Silky Aftertaste.'),
('Aero-latte', 'Basic Brew', 12.90, 14.90, 'styles/images/Aero-Latte.jpg', 'Made by Freshly-brewed Latte, Ice and Icy Cold Water to Create a Smooth and Silky Aftertaste.'),

-- Artisan Brew
('Butterscotch Latte', 'Artisan Brew', 11.90, 13.90, 'styles/images/Butterscotch_Latte.jpg', 'Rich Espresso, Creamy Milk, and Butterscotch Syrup Served Over Ice.'),
('Butterscotch Creme', 'Artisan Brew', 14.90, 16.90, 'styles/images/Butterscotch_Creme_Latte.jpg', 'Rich Espresso, Creamy Milk, Butterscotch Syrup and Topped with a Creamy Foam.'),
('Mint Latte', 'Artisan Brew', 12.90, 14.90, 'styles/images/Mint_Latte.jpg', 'Espresso, Cool Mint, and Creamy Milk Blend and Served Over Ice.'),
('Vienna Latte', 'Artisan Brew', 14.90, 16.90, 'styles/images/Vienna_Latte.jpg', 'Rich and Velvety Drink Combining Cream with Roasted Nuts and Savory Undertones.'),
('Pistachio Latte', 'Artisan Brew', 15.90, 17.90, 'styles/images/Pistachio_Latte.jpg', 'Chilled Espresso, Creamy Milk, and Pistachio Syrup, Served Over Ice.'),
('Strawberry Latte', 'Artisan Brew', 14.90, 16.90, 'styles/images/Strawberry_Latte.jpg', 'Blend of Fruits with the Richness of Nuts for Invigorating Flavor.'),
('Mocha', 'Artisan Brew', 11.90, 13.90, 'styles/images/Mocha.jpg', 'Espresso, Milk, and Chocolate Syrup Served Over Ice.'),
('Mint Mocha', 'Artisan Brew', 12.90, 14.90, 'styles/images/No_image.jpg', 'Espresso, Milk, Chocolate Syrup, and Hint of Minty Flavors.'),
('Orange Mocha', 'Artisan Brew', 12.90, 14.90, 'styles/images/Orange_Mocha.jpg', 'Espresso, Milk, Chocolate Syrup, Finished with Orange Syrup.'),
('Yuzu Americano', 'Artisan Brew', 13.90, 15.90, 'styles/images/Yuzu_Americano.jpg', 'Chilled Espresso with Cold Water and Ice Combined with Zesty Citrus.'),
('Cheese Americano', 'Artisan Brew', 13.90, 15.90, 'styles/images/Cheese_Americano.jpg', 'Chilled Espresso with Cheesy Cream Foam.'),
('Orange Americano', 'Artisan Brew', 13.90, 15.90, 'styles/images/Orange_Americano.jpg', 'Chilled Espresso with Fruity Aftertaste.'),

-- Non-coffee
('Chocolate', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Milk Mixed with Chocolate Syrup and Served Cold.'),
('Mint Chocolate', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Milk Mixed with Chocolate Syrup with Minty Aftertaste.'),
('Orange Chocolate', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Milk Mixed with Chocolate Syrup and Zesty Orange.'),
('Yuzu Soda', 'Non-coffee', 13.90, 15.90, 'styles/images/No_image.jpg', 'Sparkling Drink with Zesty, Tangy, Citrusy Flavor.'),
('Strawberry Soda', 'Non-coffee', 13.90, 15.90, 'styles/images/Strawberry_Soda.jpg', 'Fizzy Blend with Strawberry Syrup.'),
('Yuzu Cheese', 'Non-coffee', 13.90, 15.90, 'styles/images/Yuzu_Cheese.jpg', 'Tangy Drink with Cheesy Cream Foam.'),
('Yuri Matcha', 'Non-coffee', 13.90, 15.90, 'styles/images/Yuri_Matcha.jpg', 'Smooth Blend of Premium Matcha and Creamy Milk.'),
('Strawberry Matcha', 'Non-coffee', 14.90, 16.90, 'styles/images/Strawberry_Matcha.jpg', 'Matcha and Creamy Milk with Strawberry Aftertaste.'),
('Yuzu Matcha', 'Non-coffee', 14.90, 16.90, 'styles/images/Yuzu_Matcha.jpg', 'Premium Matcha with Creamy Milk and Zesty Syrup.'),
('Houjicha', 'Non-coffee', 13.90, 15.90, 'styles/images/Houjicha.jpg', 'Roasted Japanese Green Tea Served With Ice.'),

-- Hot Beverages
('Americano', 'Hot Beverages', 7.90, 9.90, 'styles/images/No_image.jpg', 'Espresso Blended with Hot Water for a Smooth, Rich Flavor.'),
('Latte', 'Hot Beverages', 9.90, 11.90, 'styles/images/No_image.jpg', 'Espresso Mixed with Steamed Milk, Topped with Foam.'),
('Butterscotch Latte', 'Hot Beverages', 10.90, 12.90, 'styles/images/No_image.jpg', 'Espresso, Steamed Milk and Butterscotch Syrup, Topped with Foam.'),
('Cappuccino', 'Hot Beverages', 10.90, 12.90, 'styles/images/No_image.jpg', 'Rich Espresso, Steamed Milk, Thick Velvety Foam.'),
('Chocolate', 'Hot Beverages', 12.90, 14.90, 'styles/images/No_image.jpg', 'Steamed Milk mixed with Chocolate Syrup.'),
('Yuri Matcha', 'Hot Beverages', 13.90, 14.90, 'styles/images/No_image.jpg', 'Premium Matcha and Creamy Milk, Served Hot.'),
('Houjicha', 'Hot Beverages', 13.90, 14.90, 'styles/images/No_image.jpg', 'Roasted Japanese Green Tea.');
