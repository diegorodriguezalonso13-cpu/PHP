<?php

declare(strict_types=1);

if (!function_exists('printTableHeader')) {
    /**
     * @param array $cabeceras array con los nombres de las cabeceras
     * @param int $currentOrder campo por el que se está ordenando el listado actualmente
     * @param string|null $sentido sentido por el que se está ordenando actualmente. Si es vacío se asume asc
     * @param string $queryParams parámetros get de filtrado
     * @param string|null $baseUrl url relativa del enlace. Si es vacía se asume la current_url
     * @return string thead completo para una tabla
     */
    function printTableHeader(array $cabeceras, int $currentOrder = 1, string $sentido = null, string $queryParams = '', ?string $baseUrl = null): string
    {
        $result = '<thead><tr>';
        if ($baseUrl === null) {
            $baseUrl = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        }
        $i = 1;
        foreach ($cabeceras as $value) {
            $urlOrdenacion = "{$baseUrl}?order={$i}";
            if ($currentOrder === $i && ($sentido === null || $sentido !== 'desc')) {
                $urlOrdenacion .= '&sentido=desc';
            }
            $urlOrdenacion .= ($queryParams === '') ? '' : "&$queryParams";

            $result .= '<th>' . "<a href=\"$urlOrdenacion\">$value</a>";
            if ($currentOrder === $i) {
                $result .= ($sentido === null || $sentido !== 'desc') ? ' <i class="fas fa-sort-amount-down-alt"></i>' : ' <i class="fas fa-sort-amount-up-alt"></i>';
            }
            $result .= '</th>';
            $i++;
        }
        $result .= '</tr></thead>';
        return $result;
    }
}

if (!function_exists('paginado')) {

    function paginado(int $pages, int $currentPage = 1, string $queryParams = '', ?string $baseUrl = null): string
    {
        $resultado = '<ul class="pagination justify-content-center">"';
        if ($baseUrl === null) {
            $baseUrl = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        }

        if ($currentPage === 1) {
            $urlPaginado = "{$baseUrl}?page={$currentPage}";
            $urlPaginado .= ($queryParams === '') ? '' : "&$queryParams";
            $resultado .= '<li>' . "<a href=\"$urlPaginado\" aria-label='First'><span aria-hidden='true'>&laquo;</span>
                                <span class='sr-only'>First</span></a>" . '</li>';
            $resultado .= '<li>' . "<a href=\"$urlPaginado\" aria-label='Next'>
                            <span aria-hidden='true'>&gt;</span>
                            <span class='sr-only'>Next</span></a>". '</li>';
            $resultado .= '<li>' . "<a href=\"$urlPaginado\" aria-label='Last'>
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Last</span></a>" . '</li>';

        } elseif ($currentPage > 1 && $currentPage < $pages) {

        } elseif ($currentPage === $pages) {
            $urlPaginado = "{$baseUrl}?page={$currentPage}";
            $urlPaginado .= ($queryParams === '') ? '' : "&$queryParams";


            $resultado .= '<li>' . "<a href=\"$urlPaginado\" aria-label='Last'>
                            <span aria-hidden='true'>&raquo;</span>
                            <span class='sr-only'>Last</span></a>" . '</li>';
        }


        $resultado .= '</ul>';
        return $resultado;
    }
}
