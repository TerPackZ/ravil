<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@newcar.local'],
            [
                'name' => 'Администратор',
                'phone' => '+7 (900) 000-00-00',
                'password' => 'password',
                'is_admin' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'client@newcar.local'],
            [
                'name' => 'Клиент NewCar',
                'phone' => '+7 (901) 111-22-33',
                'password' => 'password',
                'is_admin' => false,
            ]
        );

        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'slug' => 'toyota-camry-2024',
                'year' => 2024,
                'price' => 3590000,
                'mileage' => 0,
                'engine' => '2.5 Hybrid',
                'transmission' => 'AT',
                'color' => 'Белый перламутр',
                'description' => 'Бизнес-седан с высоким уровнем комфорта, современными системами безопасности и экономичным гибридным двигателем.',
                'image' => '/images/cars/toyota-camry.jpg',
                'is_featured' => true,
            ],
            [
                'brand' => 'BMW',
                'model' => 'X5',
                'slug' => 'bmw-x5-2023',
                'year' => 2023,
                'price' => 6890000,
                'mileage' => 12000,
                'engine' => '3.0 Turbo',
                'transmission' => 'AT',
                'color' => 'Черный металлик',
                'description' => 'Премиальный кроссовер с динамичным характером, просторным салоном и продуманной цифровой экосистемой.',
                'image' => '/images/cars/bmw-x5.jpg',
                'is_featured' => true,
            ],
            [
                'brand' => 'Kia',
                'model' => 'Sportage',
                'slug' => 'kia-sportage-2024',
                'year' => 2024,
                'price' => 3140000,
                'mileage' => 0,
                'engine' => '2.0 бензин',
                'transmission' => 'AT',
                'color' => 'Серый',
                'description' => 'Городской SUV с выразительным дизайном, вместительным багажником и комфортной подвеской.',
                'image' => '/images/cars/kia-sportage.jpg',
                'is_featured' => true,
            ],
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'E 200',
                'slug' => 'mercedes-benz-e-200-2022',
                'year' => 2022,
                'price' => 5290000,
                'mileage' => 24000,
                'engine' => '2.0 бензин',
                'transmission' => 'AT',
                'color' => 'Синий',
                'description' => 'Элегантный седан для тех, кто ценит статус, комфорт и сбалансированную управляемость.',
                'image' => '/images/cars/mercedes-e200.jpg',
                'is_featured' => false,
            ],
        ];

        foreach ($cars as $car) {
            Car::query()->updateOrCreate(['slug' => $car['slug']], $car);
        }

        $newsItems = [
            [
                'title' => 'Весенняя выгода на новые автомобили',
                'slug' => 'spring-offer',
                'excerpt' => 'Специальные условия на популярные модели до конца месяца.',
                'content' => 'В автосалоне NewCar стартовала сезонная акция с выгодными условиями на покупку новых автомобилей и расширенными программами трейд-ин.',
                'image' => '/images/news/spring-offer.jpg',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Открытие обновленного шоурума',
                'slug' => 'new-showroom',
                'excerpt' => 'Приглашаем оценить новый интерьер, зону выдачи и клиентский лаунж.',
                'content' => 'Мы обновили пространство шоурума, чтобы выбор автомобиля стал еще комфортнее: больше света, удобные переговорные и цифровые конфигураторы.',
                'image' => '/images/news/new-showroom.jpg',
                'published_at' => now()->subWeek(),
            ],
        ];

        foreach ($newsItems as $newsItem) {
            News::query()->updateOrCreate(['slug' => $newsItem['slug']], $newsItem);
        }
    }
};
