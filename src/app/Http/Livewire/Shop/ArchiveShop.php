<?php
namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\Course;
use Carbon\Carbon;

class ArchiveShop extends Component
{
    public $courses;
    public $perPage = 50; // Количество курсов на одной странице
    public $currentPage = 1; // Текущая страница
    public $totalCourses; // Общее количество курсов
    public $minCourseNumber; // Минимальный номер курса на текущей странице
    public $maxCourseNumber; // Максимальный номер курса на текущей странице

    public function mount()
    {
        // Определяем начало текущей недели (понедельник)
        $startOfCurrentWeek = Carbon::now()->startOfWeek();
        
        // Получаем общее количество архивных курсов до начала текущей недели
        $this->totalCourses = Course::where('created_at', '<', $startOfCurrentWeek)->count();

        // Загружаем курсы для первой страницы
        $this->loadCourses();
    }

    public function loadCourses()
    {
        // Определяем начало текущей недели (понедельник)
        $startOfCurrentWeek = Carbon::now()->startOfWeek();

        // Получаем курсы для текущей страницы, отсортированные по возрастанию по полю number
        $this->courses = Course::where('created_at', '<', $startOfCurrentWeek)
            ->orderBy('number', 'asc') // Сортировка по номеру курса
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();

        // Определяем минимальный и максимальный номер курсов на текущей странице
        $this->minCourseNumber = $this->courses->min('number');
        $this->maxCourseNumber = $this->courses->max('number');
    }

    public function nextPage()
    {
        // Переход на следующую страницу, если она существует
        if ($this->currentPage * $this->perPage < $this->totalCourses) {
            $this->currentPage++;
            $this->loadCourses();
        }
    }

    public function previousPage()
    {
        // Переход на предыдущую страницу, если это не первая страница
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->loadCourses();
        }
    }

    public function render()
    {
        return view('livewire.shop.archive-shop', [
            'isNextDisabled' => $this->currentPage * $this->perPage >= $this->totalCourses,
            'isPrevDisabled' => $this->currentPage == 1,
        ]);
    }
}
