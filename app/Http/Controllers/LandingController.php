<?php

namespace App\Http\Controllers;

use App\Models\CouncilEquipment;
use App\Services\ActivityService;
use App\Services\AspirationService;
use App\Services\CouncilEquipmentService;
use App\Services\CouncilMemberService;
use App\Services\CouncilStructureService;
use App\Services\HeroSectionService;
use App\Services\NewsService;
use App\Services\OrganizationDataService;
use App\Services\RegionPhotoService; // Import Service


class LandingController extends Controller
{
    protected HeroSectionService $heroSectionService;
    protected RegionPhotoService $regionPhotoService;
    protected CouncilMemberService $councilMemberService;
    protected ActivityService $activityService;
    protected OrganizationDataService $organizationDataService;
    protected CouncilEquipmentService $councilEquipmentService;
    protected CouncilStructureService $councilStructureService;
    protected NewsService $newsService;
    protected AspirationService $aspirationService;

    public function __construct(
        HeroSectionService $heroSectionService,
        RegionPhotoService $regionPhotoService,
        CouncilMemberService $councilMemberService,
        ActivityService $activityService,
        OrganizationDataService $organizationDataService,
        CouncilEquipmentService $councilEquipmentService,
        CouncilStructureService $councilStructureService,
        NewsService $newsService,
        AspirationService $aspirationService
    ) {
        $this->heroSectionService = $heroSectionService;
        $this->regionPhotoService = $regionPhotoService;
        $this->councilMemberService = $councilMemberService;
        $this->activityService = $activityService;
        $this->organizationDataService = $organizationDataService;
        $this->councilEquipmentService = $councilEquipmentService;
        $this->councilStructureService = $councilStructureService;
        $this->newsService = $newsService;
        $this->aspirationService = $aspirationService;
    }

    public function index()
    {
        $hero = $this->heroSectionService->getHeroData();

        // Ambil data foto daerah
        $regions = $this->regionPhotoService->getAllPhotos();

        // Ambil data anggota dewan
        $members = $this->councilMemberService->getAllMembers();

        $activities = $this->activityService->getTodayActivities();

        $organizations = $this->organizationDataService->getAllData();

        $councilEquipments = $this->councilEquipmentService->getAll();

        $councilStructure = $this->councilStructureService->getStructure();

        $newsList = $this->newsService->getallnews();

        $aspirations = $this->aspirationService->getPublishedForLanding();

        return view('landing', compact('hero', 'regions', 'members', 'activities', 'organizations', 'councilEquipments', 'councilStructure', 'newsList', 'aspirations'));
    }

    public function showEquipment($slug)
    {
        $equipment = CouncilEquipment::where('slug', $slug)->firstOrFail();

        return view('landing.equipment_detail', compact('equipment'));
    }
}
