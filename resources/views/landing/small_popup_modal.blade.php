<?php

use App\Models\room;

?>

<style>
  .small-popup-container {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 99999;
    width: 380px;
    transform: translateX(-120%);
    opacity: 0;
    transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55), opacity 0.3s ease;
    pointer-events: none;
  }

  .small-popup-container.show {
    transform: translateX(0);
    opacity: 1;
    pointer-events: auto;
  }

  .small-popup-container.hiding {
    transform: translateX(-120%);
    opacity: 0;
    transition: transform 0.4s cubic-bezier(0.6, 0, 0.8, 0.2), opacity 0.4s ease;
    pointer-events: none;
  }

  .popup-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
    animation: slideIn 0.5s ease-out;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(-30px) scale(0.95);
    }

    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .popup-close {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 10;
    width: 32px;
    height: 32px;
    background: rgba(220, 38, 38, 0.9);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-weight: bold;
    font-size: 16px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
  }

  .popup-close:hover {
    background: rgba(185, 28, 28, 1);
    transform: rotate(90deg) scale(1.1);
  }

  .popup-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
  }

  .popup-details {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 16px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.6) 70%, transparent 100%);
  }

  .popup-room-type {
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 6px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  .popup-room-price {
    font-size: 16px;
    font-weight: 600;
    color: #F7B32B;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }

  .room-book-btn {
    background: #F7B32B;
    color: #0A1128;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(247, 179, 43, 0.3);
    display: inline-block;
  }

  .room-book-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(247, 179, 43, 0.4);
    background: #e6a425;
  }

  .promo-image-clickable {
    cursor: pointer;
  }

  @media (max-width: 640px) {
    .small-popup-container {
      width: 90%;
      max-width: 350px;
      left: 5%;
    }

    .popup-image {
      height: 200px;
    }

    .popup-room-type {
      font-size: 16px;
    }

    .popup-room-price {
      font-size: 14px;
    }

    .room-book-btn {
      font-size: 12px;
      padding: 7px 16px;
    }
  }
</style>

<!-- Small Popup Modal -->
<div id="smallPopupModal" class="small-popup-container">
  <div class="popup-card">
    @php
      // Get random item (promo or room)
      $allItems = [];

      // Add promos
      if (isset($promos) && $promos->count() > 0) {
        foreach ($promos as $promo) {
          $allItems[] = [
            'type' => 'promo',
            'title' => $promo->hotelpromoname ?? 'Special Promotion',
            'image' => $promo->hotelpromophoto ?? asset('images/defaults/promo-default.jpg'),
          ];
        }
      }

      // Add rooms
      if (isset($rooms) && $rooms->count() > 0) {
        foreach ($rooms as $room) {
          // Get a sample room to get roomID
          $sampleRoom = room::where('roomtype', $room->roomtype)
            ->where('roomstatus', 'Available')
            ->inRandomOrder()
            ->first();
          
          $allItems[] = [
            'type' => 'room',
            'title' => $room->roomtype,
            'image' => $room->sample_photo ?? asset('images/defaults/rooms/default-room.jpg'),
            'price' => $room->sample_price ?? 0,
            'roomID' => $sampleRoom ? $sampleRoom->roomID : null,
          ];
        }
      }

      // Get random item
      if (!empty($allItems)) {
        $displayItem = $allItems[array_rand($allItems)];
      } else {
        // Fallback content
        $displayItem = [
          'type' => 'room',
          'title' => 'Deluxe Room',
          'image' => asset('images/defaults/rooms/default-room.jpg'),
          'price' => 0,
          'roomID' => null, // Dynamic - will be null if no rooms available
        ];
      }
    @endphp

    <!-- Close Button -->
    <button onclick="closeSmallPopup()" class="popup-close">
      ✕
    </button>

    <!-- Image -->
    @if($displayItem['type'] === 'promo')
      <img src="{{ $displayItem['image'] }}" alt="{{ $displayItem['title'] }}" class="popup-image promo-image-clickable"
        onclick="bookFromPopup('{{ $displayItem['type'] }}', '{{ $displayItem['title'] }}')">
    @else
      <img src="{{ $displayItem['image'] }}" alt="{{ $displayItem['title'] }}" class="popup-image">

      <!-- Room Details - Overlapping the image -->
      <div class="popup-details">
        <div class="popup-room-type">{{ $displayItem['title'] }}</div>
        <div class="popup-room-price">₱{{ number_format($displayItem['price'], 2) }} / night</div>
        <button onclick="bookFromPopup('{{ $displayItem['type'] }}', '{{ $displayItem['title'] }}', '{{ $displayItem['roomID'] ?? '' }}')"
          class="room-book-btn">
          Book Now
        </button>
      </div>
    @endif
  </div>
</div>

<script>
  function closeSmallPopup() {
    const popup = document.getElementById('smallPopupModal');
    if (popup) {
      // Add hiding class for slide-left exit animation
      popup.classList.remove('show');
      popup.classList.add('hiding');

      // Remove from DOM after animation completes
      setTimeout(() => {
        if (popup && popup.parentNode) {
          popup.parentNode.removeChild(popup);
        }
      }, 400); // Match the transition duration
    }
  }

  function bookFromPopup(type, title, roomID = null) {
    closeSmallPopup();
    if (type === 'promo') {
      window.location.href = '/roomselectionlanding?promo=' + encodeURIComponent(title);
    } else {
      if (roomID) {
        window.location.href = '/selectedroom/' + roomID;
      } else {
        window.location.href = '/roomselectionlanding?room=' + encodeURIComponent(title);
      }
    }
  }

  function initAndShowPopup() {
    const smallPopup = document.getElementById('smallPopupModal');
    if (!smallPopup) return;

    setTimeout(() => {
      if (smallPopup && smallPopup.parentNode) {
        smallPopup.classList.add('show');
      }
    }, 2000);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAndShowPopup);
  } else {
    initAndShowPopup();
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeSmallPopup();
    }
  });

  window.closeSmallPopup = closeSmallPopup;
  window.bookFromPopup = bookFromPopup;
</script>