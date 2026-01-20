# K123 訂房系統 (Hotel Booking System)

這是一個基於 Laravel 與 Docker 建置的現代化訂房系統專案。提供會員註冊、線上訂房、以及完整的後台管理功能。

## ✨ 專案特色

*   **現代化介面**: 採用 Dark Mode 深色風格設計，搭配流暢的互動體驗與 RWD 響應式佈局。
*   **完整的會員機制**: 包含註冊、登入（含圖形驗證碼）、我的訂房管理。
*   **強大的後台管理**:
    *   **儀表板**: 總覽所有訂房狀態。
    *   **房況表**: 視覺化檢視每日房況（空房/已訂）。
    *   **會員管理**: 管理會員權限與資料。
    *   **系統設定**: 可動態調整「開放訂房天數」或是「暫停訂房」模式 (如遇維修或假期)。
*   **彈性的訂房規則**:
    *   限制只能預訂未來特定天數內的房間（預設 14 天，可後台調整）。
    *   同一天同一間房僅能被單一用戶預訂。
    *   入住前 2 天可免費取消，否則無法退房。
*   **容器化部署**: 使用 Docker Compose 快速建置，環境一致且易於遷移。

## 🛠️ 技術棧

*   **框架**: [Laravel 11](https://laravel.com/)
*   **資料庫**: MariaDB 10.6+
*   **前端**: Blade Templates, Vanilla CSS (Glassmorphism Style), Flatpickr (Calendar)
*   **環境**: Docker & Docker Compose
*   **其他套件**: `mews/captcha` (驗證碼)

## 🚀 快速開始

### 前置需求

確保您的電腦已安裝：
*   [Docker](https://www.docker.com/)
*   [Docker Compose](https://docs.docker.com/compose/)

### 安裝步驟

1.  **複製專案**
    ```bash
    git clone https://github.com/Start-Rail/k123-booking-system.git
    cd k123-booking-system
    ```

2.  **啟動容器**
    使用 Docker Compose 啟動服務（首次啟動會自動建置映像檔與安裝依賴）：
    ```bash
    docker-compose up -d
    ```

3.  **初始化設定 (首次執行)**
    進入容器並執行必要的初始化指令：
    ```bash
    # 進入 Laravel 容器
    docker-compose exec laravel bash

    # 安裝依賴 (如果尚未安裝)
    composer install

    # 複製環境變數檔
    cp .env.example .env

    # 產生應用程式金鑰
    php artisan key:generate

    # 執行資料庫遷移與種子資料 (建立預設管理員與房間)
    php artisan migrate:fresh --seed

    # 離開容器
    exit
    ```

4.  **開始使用**
    開啟瀏覽器訪問：[http://localhost:8000](http://localhost:8000)

## 👤 預設帳號

### 管理員 (Admin)
*   **帳號**: `admin`
*   **密碼**: `111`
*   **權限**: 可進入 `/admin` 後台，管理所有資料與系統參數。

### 測試會員
您可以自行註冊新帳號，或查看 Seed 產生的測試資料。

## ⚙️ 系統設定功能
管理員登入後台後，可至「系統設定」頁面：
*   **開放訂房天數**: 設定首頁日曆可選的未來天數範圍。
*   **訂房狀態**: 可一鍵切換「正常開放」或「暫停訂房」。暫停時前台將無法進行新預訂。

## 📂 專案結構
*   `app/Models`: 定義 User, Room, Booking, SystemSetting 模型。
*   `app/Http/Controllers`: 包含 Auth, Booking, Admin 控制器邏輯。
*   `resources/views`: Blade 視圖檔案。
*   `database/migrations`: 資料庫結構定義。
*   `docker-compose.yml`: Docker 服務定義。

## 📝 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---
Designed & Developed by [Yauger 練習](https://yes.k123.tw)
