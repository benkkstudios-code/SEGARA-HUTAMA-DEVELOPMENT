<?php

namespace App\Config;


class constants
{
    // String Untuk Menu
    const HomeMenu = "Home";
    const ProfileMenu = "Tentang Kami";
    const PerkenalanMenu = "Perkenalan";
    const BuletinMenu = "Buletin";
    const PenghargaanMenu = "Penghargaan";
    const KantorMenu = "Mitra Kami";
    const PungggawaMenu = "Pungggawa";
    const LegalitasMenu = "Legalitas";
    const ServicesMenu = "Layanan";
    const ProjectMenu = "Project";
    const DireksiMenu = "Direksi";
    const ContactMenu = "Hubungi Kami";
    const GaleryMenu = "Galeri";
    const testimoniMenu = "testimoni";

    // String Untuk Navigasi Bagian Admin
    const Buletin = "Buletin";
    const Carousel = "Image Slider";
    const Direksi = "Direksi";
    const Kantor = "Mitra Kami";
    const Keunggulan = "Keunggulan";
    const Website = "Pengaturan";
    const Legalitas = "Legalitas";
    const Penghargaan = "Penghargaan";
    const Perkenalan = "Perkenalan";
    const Punggawa = "Punggawa";
    const Services = "Layanan";
    const Project = "Project";
    const Testimoni = "Testimoni";



    // Jangan Dirubah
    public static function createMenu()
    {
        return [
            'home' => constants::HomeMenu,
            'profile' => constants::ProfileMenu,
            'perkenalan' => constants::PerkenalanMenu,
            'penghargaan' => constants::PenghargaanMenu,
            'buletin' => constants::BuletinMenu,
            'kantor' => constants::KantorMenu,
            'punggawa' => constants::PungggawaMenu,
            'legalitas' => constants::LegalitasMenu,
            'service' => constants::ServicesMenu,
            'direksi' => constants::DireksiMenu,
            'contact' => constants::ContactMenu,
            'project' => constants::ProjectMenu,
            'galery' => constants::GaleryMenu,
            'testi' => constants::testimoniMenu,
        ];
    }
}
