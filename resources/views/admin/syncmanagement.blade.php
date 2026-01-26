<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  @vite('resources/css/app.css')
  <script src="https://unpkg.com/lucide@latest"></script>
  <title>Sync Management - Front Desk And Reception</title>
</head>
@auth

  <body class="bg-base-100">
    <div class="flex h-screen overflow-hidden">
      <!-- Sidebar -->
      @include('admin.components.dashboard.sidebar')

      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Navbar -->
        @include('admin.components.dashboard.navbar')

        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 transition-slow">
          {{-- Subsystem Name --}}
          <div class="pb-5 border-b border-base-300 animate-fadeIn">
            <h1 class="text-2xl font-bold bg-white bg-clip-text text-[#191970]">Sync Management Center</h1>
            <p class="text-sm text-base-content/70 mt-1">Manage offline/online synchronization between localhost and
              domain</p>
          </div>
          {{-- Subsystem Name --}}

          {{-- content --}}

          <!-- Sync Status Cards -->
          <section class="flex-1 p-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

              <!-- Pending Sync -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pending Sync</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="pendingCount">0</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">Awaiting Sync</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="bx bx-time-five text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Synced Today -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Synced Today</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="syncedCount">0</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-green-600">Successfully Synced</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="bx bx-check-circle text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Failed Sync -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Failed Today</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="failedCount">0</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">Needs Attention</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="bx bx-error-circle text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

              <!-- Last Sync -->
              <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-lg card-hover stat-card">
                <div class="flex items-center justify-between">
                  <div>
                    <h3 class="text-sm font-medium text-gray-600 uppercase tracking-wide">Last Sync</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="lastSync">Never</p>
                    <div class="flex items-center mt-3">
                      <span class="text-sm font-medium text-gray-500">Last Update</span>
                    </div>
                  </div>
                  <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-blue-900">
                    <i class="bx bx-sync text-yellow-400 text-2xl"></i>
                  </div>
                </div>
              </div>

            </div>

            <!-- Control Panel -->
            <div class="overflow-x-auto mt-5 rounded-xl border border-gray-100 shadow-lg">
              <!-- Header -->
              <div
                class="bg-blue-900 text-white px-6 py-4 rounded-t-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-lg font-semibold">Sync Control Panel</h2>
                  <p class="text-sm opacity-80">Manage synchronization operations</p>
                </div>
              </div>

              <!-- Control Buttons -->
              <div class="bg-white p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <!-- Manual Sync Button -->
                  <div class="text-center">
                    <button onclick="performSync()" id="syncBtn"
                      class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 flex items-center justify-center gap-2">
                      <i class="bx bx-upload"></i>
                      <span>Send to Domain</span>
                    </button>
                    <p class="text-xs text-gray-500 mt-2">Sync pending data to domain server</p>
                  </div>

                  <!-- Test Connection -->
                  <div class="text-center">
                    <button onclick="testConnection()" id="testBtn"
                      class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 flex items-center justify-center gap-2">
                      <i class="bx bx-wifi"></i>
                      <span>Test Connection</span>
                    </button>
                    <p class="text-xs text-gray-500 mt-2">Test domain API connectivity</p>
                  </div>

                  <!-- Refresh Data -->
                  <div class="text-center">
                    <button onclick="refreshData()"
                      class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-200 flex items-center justify-center gap-2">
                      <i class="bx bx-refresh"></i>
                      <span>Refresh Data</span>
                    </button>
                    <p class="text-xs text-gray-500 mt-2">Refresh sync statistics</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Real-time Logs -->
            <div class="overflow-x-auto mt-5 rounded-xl border border-gray-100 shadow-lg">
              <!-- Header -->
              <div
                class="bg-blue-900 text-white px-6 py-4 rounded-t-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-lg font-semibold">Real-time Sync Logs</h2>
                  <p class="text-sm opacity-80">Monitor synchronization activities</p>
                </div>
                <div class="flex gap-2">
                  <button onclick="clearLogs()"
                    class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors">
                    <i class="bx bx-trash"></i> Clear
                  </button>
                  <button onclick="toggleAutoScroll()" id="autoScrollBtn"
                    class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition-colors">
                    <i class="bx bx-arrow-to-bottom"></i> Auto-scroll: ON
                  </button>
                </div>
              </div>

              <!-- Logs Container -->
              <div class="bg-white p-4">
                <div id="logsContainer"
                  class="bg-gray-50 rounded-lg p-4 h-96 overflow-y-auto font-mono text-sm border border-gray-200">
                  <div class="text-gray-500">Waiting for sync logs...</div>
                </div>
              </div>
            </div>

            <!-- Pending Sync Queue -->
            <div class="overflow-x-auto mt-5 rounded-xl border border-gray-100 shadow-lg">
              <!-- Header -->
              <div
                class="bg-blue-900 text-white px-6 py-4 rounded-t-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-lg font-semibold">Pending Sync Queue</h2>
                  <p class="text-sm opacity-80">Items waiting to be synchronized</p>
                </div>
              </div>

              <!-- Table -->
              <table class="table w-full">
                <thead class="bg-gray-100">
                  <tr>
                    <th>ID</th>
                    <th>Model</th>
                    <th>Action</th>
                    <th>Record ID</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="syncQueueTable">
                  <tr>
                    <td colspan="7" class="text-center py-8 text-gray-500">Loading pending sync items...</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-6">
              <div class="join">
                <button class="join-item btn btn-sm">«</button>
                <button class="join-item btn btn-sm btn-active">1</button>
                <button class="join-item btn btn-sm">2</button>
                <button class="join-item btn btn-sm">3</button>
                <button class="join-item btn btn-sm">»</button>
              </div>
            </div>
          </section>

          <!-- Initialize Lucide Icons -->
          <script src="https://unpkg.com/lucide@latest"></script>
          <script>
            lucide.createIcons();
          </script>

        </main>
      </div>
    </div>

    {{-- modals --}}

    <!-- Status Modal -->
    <div id="statusModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="text-center">
          <div id="modalIcon" class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center">
            <i class="bx bx-loader-alt bx-spin text-2xl text-white"></i>
          </div>
          <h3 id="modalTitle" class="text-lg font-semibold mb-2">Processing...</h3>
          <p id="modalMessage" class="text-base-content/70 mb-4">Please wait while we process your request.</p>
          <div id="modalProgress" class="w-full bg-base-200 rounded-full h-2 mb-4 hidden">
            <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
          </div>
          <button onclick="closeModal()"
            class="bg-base-300 text-base-content px-4 py-2 rounded hover:bg-base-400 transition-colors">
            Close
          </button>
        </div>
      </div>
    </div>

    <!-- DaisyUI Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
      <div class="modal-box">
        <h3 class="font-bold text-lg">Confirm Delete</h3>
        <p class="py-4">Are you sure you want to delete this sync item? This action cannot be undone.</p>
        <div class="modal-action">
          <button onclick="closeDeleteModal()" class="btn btn-ghost">Cancel</button>
          <button onclick="confirmDelete()" class="btn btn-error">Delete</button>
        </div>
      </div>
    </div>

    <script>
      let autoScroll = true;
      let syncInterval;
      let deleteItemId = null;

      // Initialize
      document.addEventListener('DOMContentLoaded', function () {
        refreshData();
        startRealTimeUpdates();
      });

      // Real-time updates
      function startRealTimeUpdates() {
        refreshData();
        syncInterval = setInterval(refreshData, 5000); // Update every 5 seconds
      }

      // Refresh all data
      async function refreshData() {
        await Promise.all([
          updateSyncStats(),
          updateSyncQueue(),
          fetchLogs()
        ]);
      }

      // Update sync statistics
      async function updateSyncStats() {
        try {
          const response = await fetch('/api/sync-stats');
          const data = await response.json();

          document.getElementById('pendingCount').textContent = data.pending || 0;
          document.getElementById('syncedCount').textContent = data.synced_today || 0;
          document.getElementById('failedCount').textContent = data.failed_today || 0;
          document.getElementById('lastSync').textContent = data.last_sync || 'Never';
        } catch (error) {
          console.error('Error updating stats:', error);
        }
      }

      // Update sync queue
      async function updateSyncQueue() {
        try {
          const response = await fetch('/api/sync-queue');
          const items = await response.json();

          const tbody = document.getElementById('syncQueueTable');
          if (items.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" class="text-center py-8 text-gray-500">No pending sync items</td></tr>';
            return;
          }

          tbody.innerHTML = items.map(item => `
              <tr class="hover:bg-gray-50">
                <td>${item.id}</td>
                <td>
                  <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">${item.model_name}</span>
                </td>
                <td>
                  <span class="bg-${getActionColor(item.action)}-100 text-${getActionColor(item.action)}-800 px-2 py-1 rounded text-xs">${item.action}</span>
                </td>
                <td>${item.record_id}</td>
                <td>${formatDate(item.created_at)}</td>
                <td>
                  <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Pending</span>
                </td>
                <td class="flex gap-2 justify-center items-center">
                  <button onclick="deleteSyncItem(${item.id})" class="btn btn-error btn-xs">
                    <i class="bx bx-trash"></i> Delete
                  </button>
                </td>
              </tr>
            `).join('');
        } catch (error) {
          console.error('Error updating queue:', error);
        }
      }

      // Perform sync
      async function performSync() {
        const btn = document.getElementById('syncBtn');
        const originalContent = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Syncing...';

        showModal('processing', 'Syncing Data', 'Sending pending data to domain server...');

        try {
          const response = await fetch('/sync-offline', {
            method: 'GET',
            headers: {
              'Accept': 'application/json',
            }
          });

          const result = await response.json();

          if (response.ok) {
            showModal('success', 'Sync Complete', `Successfully synced ${result.success_count} items. ${result.error_count} failed.`);
            await refreshData();
          } else {
            showModal('error', 'Sync Failed', result.message || 'An error occurred during sync.');
          }
        } catch (error) {
          showModal('error', 'Connection Error', 'Could not connect to domain server.');
        } finally {
          btn.disabled = false;
          btn.innerHTML = originalContent;
        }
      }

      // Test connection
      async function testConnection() {
        const btn = document.getElementById('testBtn');
        const originalContent = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Testing...';

        try {
          const response = await fetch('/api/test-sync-connection');
          const result = await response.json();

          if (result.success) {
            showModal('success', 'Connection Successful', 'Domain server is reachable and API is working.');
          } else {
            showModal('error', 'Connection Failed', result.message || 'Cannot reach domain server.');
          }
        } catch (error) {
          showModal('error', 'Connection Error', 'Could not connect to domain server.');
        } finally {
          btn.disabled = false;
          btn.innerHTML = originalContent;
        }
      }

      // Fetch logs
      async function fetchLogs() {
        try {
          const response = await fetch('/api/sync-logs');
          const logs = await response.json();

          const container = document.getElementById('logsContainer');
          if (logs.length === 0) {
            container.innerHTML = '<div class="text-gray-500">No logs available</div>';
            return;
          }

          container.innerHTML = logs.map(log => `
              <div class="mb-2 ${log.level === 'ERROR' ? 'text-red-600' : log.level === 'SUCCESS' ? 'text-green-600' : 'text-blue-600'}">
                <span class="text-gray-500">[${formatDate(log.timestamp)}]</span>
                <span class="font-semibold">[${log.level}]</span>
                ${log.message}
              </div>
            `).join('');

          if (autoScroll) {
            container.scrollTop = container.scrollHeight;
          }
        } catch (error) {
          console.error('Error fetching logs:', error);
        }
      }

      // Delete sync item with DaisyUI modal
      function deleteSyncItem(id) {
        deleteItemId = id;
        const modal = document.getElementById('deleteModal');
        modal.classList.add('modal-open');
      }

      // Close delete modal
      function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('modal-open');
        deleteItemId = null;
      }

      // Confirm delete
      async function confirmDelete() {
        if (!deleteItemId) return;

        try {
          const response = await fetch(`/api/sync-queue/${deleteItemId}`, { method: 'DELETE' });
          if (response.ok) {
            closeDeleteModal();
            await updateSyncQueue();
            showModal('success', 'Item Deleted', 'Sync item has been successfully deleted.');
          } else {
            showModal('error', 'Delete Failed', 'Could not delete the sync item.');
          }
        } catch (error) {
          console.error('Error deleting item:', error);
          showModal('error', 'Error', 'An error occurred while deleting the item.');
        }
      }

      // Clear logs
      function clearLogs() {
        document.getElementById('logsContainer').innerHTML = '<div class="text-gray-500">Logs cleared</div>';
      }

      // Toggle auto-scroll
      function toggleAutoScroll() {
        autoScroll = !autoScroll;
        const btn = document.getElementById('autoScrollBtn');
        btn.innerHTML = `<i class="bx bx-arrow-to-bottom"></i> Auto-scroll: ${autoScroll ? 'ON' : 'OFF'}`;
      }

      // Modal functions
      function showModal(type, title, message) {
        const modal = document.getElementById('statusModal');
        const icon = document.getElementById('modalIcon');
        const titleEl = document.getElementById('modalTitle');
        const messageEl = document.getElementById('modalMessage');

        titleEl.textContent = title;
        messageEl.textContent = message;

        icon.className = 'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center';
        if (type === 'success') {
          icon.classList.add('bg-green-500');
          icon.innerHTML = '<i class="bx bx-check text-2xl text-white"></i>';
        } else if (type === 'error') {
          icon.classList.add('bg-red-500');
          icon.innerHTML = '<i class="bx bx-x text-2xl text-white"></i>';
        } else {
          icon.classList.add('bg-blue-500');
          icon.innerHTML = '<i class="bx bx-loader-alt bx-spin text-2xl text-white"></i>';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (type !== 'processing') {
          setTimeout(closeModal, 3000);
        }
      }

      function closeModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }

      // Helper functions
      function getActionColor(action) {
        switch (action) {
          case 'insert': return 'green';
          case 'update': return 'yellow';
          case 'delete': return 'red';
          default: return 'blue';
        }
      }

      function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleString();
      }

      // Cleanup on page unload
      window.addEventListener('beforeunload', () => {
        if (syncInterval) {
          clearInterval(syncInterval);
        }
      });
    </script>
  </body>

@endauth
@include('javascriptfix.soliera_js')

</html>