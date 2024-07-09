<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            DepartamentosSeeder::class,
            ProvinciasSeeder::class,
            DistritosSeeder::class,
            TiposDocumentosSeeder::class,
            TiposUsuariosSeeder::class,
            EstadosAvisosSeeder::class,
            TiposOperacionesSeeder::class,
            TiposInmueblesSeeder::class,
            SubTiposInmueblesSeeder::class,
            CategoriasCaracteristicasSeeder::class,
            CaracteristicasSeeder::class,
        ]);
        /**
         * Aqui ya son seeders de prueba, que se debe de obviar para producción
         */
        $this->call([
            UsuariosSeeder::class,
            InmueblesSeeder::class,
            PrincipalInmueblesSeeder::class,
            CaracteristicasInmueblesSeeder::class,
            ExtraInmueblesSeeder::class,
            ExtraInmuebleCaracteristicasInmueblesSeeder::class,
            OperacionTipoInmueblesSeeder::class,
            UbicacionesInmueblesSeeder::class,
            MultimediaInmueblesSeeder::class,
            ImagenesInmueblesSeeder::class,
            AvisosSeeder::class,
            HistorialAvisosSeeder::class,
            UserSubscriptionSeeder::class,
            SubscriptionLevelSeeder::class,
            SubscriptionOptionSeeder::class,
            UserSubscriptionSeeder::class,
        ]);
    }
}
