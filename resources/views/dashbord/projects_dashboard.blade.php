@extends('dashbord.layouts.master')
@section('css')
    <style>
        /* Professional Dashboard Color Scheme and Styling */
        :root {
            --primary-color: #2c58a0;            /* Deep professional blue */
            --primary-light: #4b7ccf;            /* Lighter accent blue */
            --primary-dark: #1a3969;             /* Darker accent blue */
            --secondary-color: #505a68;          /* Modern slate gray */
            --success-color: #2e7d32;            /* Rich forest green */
            --warning-color: #e65100;            /* Deep orange */
            --danger-color: #c62828;             /* Deep red */
            --info-color: #0277bd;               /* Info blue */
            --light-bg: #f5f7fa;                 /* Very light blue-gray */
            --body-bg: #eef2f8;                  /* Light blue-gray background */
            --card-bg: #ffffff;                  /* White card background */
            --text-primary: #263238;             /* Near-black for primary text */
            --text-secondary: #546e7a;           /* Medium gray for secondary text */
            --text-muted: #78909c;               /* Lighter gray for muted text */
            --border-color: #e3e8ef;             /* Very light gray border */
            --header-height: 60px;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 20px rgba(0, 0, 0, 0.12);
            --transition-speed: 0.3s;
            --border-radius: 12px;
            --border-radius-sm: 8px;
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            --gradient-success: linear-gradient(135deg, #2e7d32 0%, #4caf50 100%);
            --gradient-warning: linear-gradient(135deg, #e65100 0%, #ff9800 100%);
            --gradient-danger: linear-gradient(135deg, #c62828 0%, #ef5350 100%);
        }

        body {
            background-color: var(--body-bg);
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-primary);
        }

        .main-container {
            padding: 24px;
            margin-left: 0;
            transition: all var(--transition-speed);
        }

        /* Header Styling */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .dashboard-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-dark);
            letter-spacing: -0.5px;
        }

        .dashboard-actions {
            display: flex;
            gap: 12px;
        }

        .time-filter-container {
            display: flex;
            gap: 8px;
            background-color: var(--light-bg);
            padding: 4px;
            border-radius: 24px;
            box-shadow: var(--shadow-sm);
        }

        .time-filter-btn {
            padding: 8px 18px;
            border-radius: 20px;
            background-color: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
        }

        .time-filter-btn:hover {
            color: var(--primary-color);
        }

        .time-filter-btn.active {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 10px rgba(44, 88, 160, 0.25);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: var(--card-bg);
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 20px 24px;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
        }

        .card-header i {
            font-size: 1.1rem;
            margin-right: 10px;
            color: var(--primary-color);
            opacity: 0.9;
        }

        .card-body {
            padding: 24px;
        }

        /* Stats Styling */
        .stats-container {
            display: flex;
            flex-direction: column;
        }

        .stat-item {
            margin-bottom: 18px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 4px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 0;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .stat-value.primary {
            color: var(--primary-color);
        }

        .stat-value.success {
            color: var(--success-color);
        }

        .stat-value.warning {
            color: var(--warning-color);
        }

        .stat-value.danger {
            color: var(--danger-color);
        }

        .stats-small {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 12px;
            gap: 8px;
        }

        .stat-box {
            flex: 1;
            min-width: 100px;
            padding: 16px;
            border-radius: var(--border-radius-sm);
            margin: 4px;
            transition: transform 0.2s;
        }

        .stat-box:hover {
            transform: translateY(-2px);
        }

        .stat-box-value {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .stat-box-label {
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }

        .stat-box.in-progress {
            background: linear-gradient(135deg, rgba(2, 119, 189, 0.08) 0%, rgba(33, 150, 243, 0.12) 100%);
            border-left: 3px solid var(--info-color);
        }

        .stat-box.completed {
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.08) 0%, rgba(76, 175, 80, 0.12) 100%);
            border-left: 3px solid var(--success-color);
        }

        .stat-box.on-hold {
            background: linear-gradient(135deg, rgba(230, 81, 0, 0.08) 0%, rgba(255, 152, 0, 0.12) 100%);
            border-left: 3px solid var(--warning-color);
        }

        .stat-box.in-progress .stat-box-value {
            color: var(--info-color);
        }

        .stat-box.completed .stat-box-value {
            color: var(--success-color);
        }

        .stat-box.on-hold .stat-box-value {
            color: var(--warning-color);
        }

        .view-all {
            display: inline-flex;
            align-items: center;
            margin-top: 16px;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .view-all:hover {
            color: var(--primary-light);
            transform: translateX(3px);
        }

        .view-all:after {
            content: "→";
            margin-left: 6px;
            transition: transform 0.2s;
        }

        .view-all:hover:after {
            transform: translateX(3px);
        }

        /* Tab Navigation */
        .tab-navigation {
            display: flex;
            background-color: var(--light-bg);
            border-radius: var(--border-radius-sm);
            overflow: hidden;
            margin-bottom: 20px;
            padding: 4px;
        }

        .tab-item {
            flex: 1;
            padding: 12px 16px;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.2s;
            border-radius: var(--border-radius-sm);
        }

        .tab-item:hover {
            color: var(--primary-color);
        }

        .tab-item.active {
            background-color: white;
            color: var(--primary-color);
            font-weight: 600;
            box-shadow: var(--shadow-sm);
        }

        /* Timeline Styling */
        .activity-timeline {
            padding-left: 16px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 24px;
            padding-left: 24px;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: 0;
            top: 5px;
            bottom: -10px;
            width: 2px;
            background-color: var(--border-color);
        }

        .timeline-item:last-child::before {
            display: none;
        }

        .timeline-item::after {
            content: "";
            position: absolute;
            left: -4px;
            top: 5px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(44, 88, 160, 0.2);
        }

        .timeline-badge-created::after {
            background-color: var(--success-color);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.2);
        }

        .timeline-badge-completed::after {
            background-color: var(--info-color);
            box-shadow: 0 0 0 3px rgba(2, 119, 189, 0.2);
        }

        .timeline-badge-started::after {
            background-color: var(--warning-color);
            box-shadow: 0 0 0 3px rgba(230, 81, 0, 0.2);
        }

        .timeline-content {
            margin-bottom: 6px;
        }

        .timeline-title {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }

        .timeline-text {
            margin: 6px 0 0 0;
            font-size: 14px;
            color: var(--text-primary);
        }

        .timeline-date {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .timeline-by {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        /* Highlight Colors */
        .highlight {
            color: var(--primary-color);
            font-weight: 500;
        }

        .highlight-success {
            color: var(--success-color);
            font-weight: 500;
        }

        .highlight-warning {
            color: var(--warning-color);
            font-weight: 500;
        }

        .positive-change {
            color: var(--success-color);
            display: inline-flex;
            align-items: center;
        }

        .positive-change:before {
            content: "↑";
            margin-right: 2px;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            padding: 10px;
        }

        /* Special Dashboard Row Spacing */
        .row.dashboard-row {
            margin-bottom: 24px;
        }

        /* Custom Badge Colors */
        .badge-primary {
            background-color: rgba(44, 88, 160, 0.1);
            color: var(--primary-color);
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .badge-success {
            background-color: rgba(46, 125, 50, 0.1);
            color: var(--success-color);
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .badge-warning {
            background-color: rgba(230, 81, 0, 0.1);
            color: var(--warning-color);
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .stats-small {
                flex-direction: column;
            }

            .stat-box {
                margin-bottom: 10px;
            }

            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .time-filter-container {
                width: 100%;
                justify-content: space-between;
            }

            .time-filter-btn {
                flex: 1;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 16px;
            }

            .card-header, .card-body {
                padding: 16px;
            }

            .dashboard-title {
                font-size: 24px;
            }
        }
    </style>
 @endsection
@section('content')
    <div class="main-container">
        <div class="dashboard-header">
            <div class="dashboard-title">Construction Testing Laboratory Dashboard</div>
            <div class="dashboard-actions">
                <div class="time-filter-container">
                    <button class="time-filter-btn">Today</button>
                    <button class="time-filter-btn active">This Month</button>
                    <button class="time-filter-btn">This Year</button>
                </div>
            </div>
        </div>

        <!-- Overview Stats Cards -->
        <div class="row">
            <!-- Clients Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-people"></i> Clients
                    </div>
                    <div class="card-body">
                        <div class="stats-container">
                            <div class="stat-item">
                                <div class="stat-label">Total Clients</div>
                                <div class="stat-value primary">24</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">New Clients</div>
                                <div class="stat-value success">+5</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Top Active Client</div>
                                <div class="highlight">XYZ Engineering</div>
                            </div>
                            <a href="#" class="view-all">View All Clients →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Companies Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-building"></i> Companies
                    </div>
                    <div class="card-body">
                        <div class="stats-container">
                            <div class="stat-item">
                                <div class="stat-label">Total Companies</div>
                                <div class="stat-value primary">32</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Multi-client Companies</div>
                                <div class="stat-value">14</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Most Active Company</div>
                                <div class="highlight">Concrete Masters LLC</div>
                            </div>
                            <a href="#" class="view-all">View All Companies →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-folder"></i> Projects
                    </div>
                    <div class="card-body">
                        <div class="stats-container">
                            <div class="stat-item">
                                <div class="stat-label">Total Projects</div>
                                <div class="stat-value primary">128</div>
                            </div>
                            <div style="display: flex; gap: 15px;">
                                <div>
                                    <div class="stat-label">Active</div>
                                    <div class="stat-value">52</div>
                                </div>
                                <div>
                                    <div class="stat-label">Completed</div>
                                    <div class="stat-value success">76</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">New Projects</div>
                                <div class="stat-value success">+15</div>
                            </div>
                            <a href="#" class="view-all">View All Projects →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tests Card -->
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-flask"></i> Tests
                    </div>
                    <div class="card-body">
                        <div class="stats-container">
                            <div class="stat-item">
                                <div class="stat-label">Total Tests</div>
                                <div class="stat-value primary">245</div>
                            </div>
                            <div class="stats-small">
                                <div class="stat-box in-progress">
                                    <div class="stat-box-value">64</div>
                                    <div class="stat-box-label">In Progress</div>
                                </div>
                                <div class="stat-box completed">
                                    <div class="stat-box-value">156</div>
                                    <div class="stat-box-label">Completed</div>
                                </div>
                                <div class="stat-box on-hold">
                                    <div class="stat-box-value">25</div>
                                    <div class="stat-box-label">On Hold</div>
                                </div>
                            </div>
                            <div class="stat-item mt-3">
                                <div class="stat-label">Upcoming Tests</div>
                                <div class="stat-value">42</div>
                            </div>
                            <a href="#" class="view-all">View All Tests →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Analytics & Activity Timeline -->
        <div class="row">
            <!-- Dashboard Analytics -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-graph-up"></i> Dashboard Analytics
                    </div>
                    <div class="card-body">
                        <div class="tab-navigation">
                            <div class="tab-item active" id="tab-test-distribution">Test Distribution</div>
                            <div class="tab-item" id="tab-project-trends">Project Trends</div>
                            <div class="tab-item" id="tab-material-tests">Material Tests</div>
                        </div>

                        <div class="chart-container">
                            <canvas id="testDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-activity"></i> Activity Timeline
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <div class="timeline-item timeline-badge-created">
                                <div class="timeline-content">
                                    <div class="timeline-title highlight-success">Created project</div>
                                    <div class="timeline-text">Highway Bridge Inspection</div>
                                    <div class="timeline-by">by John Smith</div>
                                </div>
                                <div class="timeline-date">2 days ago</div>
                            </div>

                            <div class="timeline-item timeline-badge-completed">
                                <div class="timeline-content">
                                    <div class="timeline-title highlight">Completed test</div>
                                    <div class="timeline-text">Concrete Compression Test</div>
                                    <div class="timeline-by">by Maria Garcia</div>
                                </div>
                                <div class="timeline-date">3 days ago</div>
                            </div>

                            <div class="timeline-item timeline-badge-started">
                                <div class="timeline-content">
                                    <div class="timeline-title highlight-warning">Started test</div>
                                    <div class="timeline-text">Soil Compaction Analysis</div>
                                    <div class="timeline-by">by Robert Lee</div>
                                </div>
                                <div class="timeline-date">5 days ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('js')
    <script>
        $(document).ready(function() {
            // Time filter buttons with enhanced animation
            $('.time-filter-btn').on('click', function() {
                $('.time-filter-btn').removeClass('active');
                $(this).addClass('active');
                // Add subtle animation when changing filter
                $('.card').addClass('animate__animated animate__fadeIn');
                setTimeout(function() {
                    $('.card').removeClass('animate__animated animate__fadeIn');
                }, 500);
                // Here you would add code to refresh data based on time filter
            });

            // Tab navigation with smooth transitions
            $('.tab-item').on('click', function() {
                $('.tab-item').removeClass('active');
                $(this).addClass('active');

                // Fade out current chart
                $('.chart-container').fadeOut(200, function() {
                    // Show appropriate chart based on selected tab
                    const tabId = $('.tab-item.active').attr('id');
                    if (tabId === 'tab-test-distribution') {
                        renderTestDistributionChart();
                    } else if (tabId === 'tab-project-trends') {
                        renderProjectTrendsChart();
                    } else if (tabId === 'tab-material-tests') {
                        renderMaterialTestsChart();
                    }
                    // Fade in new chart
                    $('.chart-container').fadeIn(300);
                });
            });

            // Initialize the charts with enhanced styling
            renderTestDistributionChart();

            // Test Distribution Chart - Professional design
            function renderTestDistributionChart() {
                const ctx = document.getElementById('testDistributionChart').getContext('2d');

                if (window.testChart) {
                    window.testChart.destroy();
                }

                // Custom tooltip styling
                Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(43, 48, 58, 0.9)';
                Chart.defaults.plugins.tooltip.titleColor = '#ffffff';
                Chart.defaults.plugins.tooltip.bodyColor = '#f5f7fa';
                Chart.defaults.plugins.tooltip.borderWidth = 0;
                Chart.defaults.plugins.tooltip.borderRadius = 8;
                Chart.defaults.plugins.tooltip.padding = 12;

                window.testChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['In Progress', 'Completed', 'On Hold'],
                        datasets: [{
                            data: [26, 64, 10],
                            backgroundColor: [
                                '#0277bd',  // Info blue for In Progress
                                '#2e7d32',  // Success green for Completed
                                '#e65100'   // Warning orange for On Hold
                            ],
                            borderWidth: 0,
                            borderRadius: 4,
                            hoverOffset: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: {
                                        family: "'Segoe UI', Roboto, 'Helvetica Neue', sans-serif",
                                        size: 13
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.raw || 0;
                                        const total = context.dataset.data.reduce((acc, data) => acc + data, 0);
                                        const percentage = Math.round((value / total) * 100);
                                        return `${label}: ${percentage}% (${value})`;
                                    }
                                }
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true,
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }
                });
            }

            // Project Trends Chart - Professional design
            function renderProjectTrendsChart() {
                const ctx = document.getElementById('testDistributionChart').getContext('2d');

                if (window.testChart) {
                    window.testChart.destroy();
                }

                // Gradient fill for the line chart
                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, 'rgba(44, 88, 160, 0.3)');
                gradient.addColorStop(1, 'rgba(44, 88, 160, 0.02)');

                window.testChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                        datasets: [{
                            label: 'New Projects',
                            data: [12, 19, 15, 17, 21, 24],
                            borderColor: '#2c58a0',
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#2c58a0',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#2c58a0',
                            pointHoverBorderColor: '#ffffff',
                            pointHoverBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    font: {
                                        family: "'Segoe UI', Roboto, 'Helvetica Neue', sans-serif",
                                        size: 12
                                    },
                                    color: '#546e7a'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        family: "'Segoe UI', Roboto, 'Helvetica Neue', sans-serif",
                                        size: 12
                                    },
                                    color: '#546e7a'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    font: {
                                        family: "'Segoe UI', Roboto, 'Helvetica Neue', sans-serif",
                                        size: 13,
                                        weight: '500'
                                    },
                                    color: '#263238'
                                }
                            },
                            tooltip: {
                                usePointStyle: true
                            }
                        },
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }
                });
            }

            // Material Tests Chart - Professional design
            function renderMaterialTestsChart() {
                const ctx = document.getElementById('testDistributionChart').getContext('2d');

                if (window.testChart) {
                    window.testChart.destroy();
                }

                window.testChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Concrete', 'Soil', 'Asphalt', 'Steel', 'Aggregate'],
                        datasets: [{
                            label: 'Test Count',
                            data: [85, 62, 49, 32, 27],
                            backgroundColor: [
                                'rgba(44, 88, 160, 0.85)',
                                'rgba(46, 125, 50, 0.85)',
                                'rgba(230, 81, 0, 0.85)',
                                'rgba(2, 119, 189, 0.85)',
                                'rgba(98, 40, 165, 0.85)'
                            ],
                            borderWidth: 0,
                            borderRadius: 6,
                            barThickness: 36,
                            maxBarThickness: 45
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    font: {
                                        family: "'Segoe UI', Roboto, 'Helvetica Neue', sans-serif",
                                        size: 12
                                    },
                                    color: '#546e7a'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        family: "'Segoe UI', Roboto, 'Helvetica Neue', sans-serif",
                                        size: 12
                                    },
                                    color: '#546e7a'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ` ${context.parsed.y} tests`;
                                    }
                                }
                            }
                        },
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        }
                    }
                });
            }

            // Add subtle hover effects on cards
            $('.card').hover(
                function() {
                    $(this).css('transform', 'translateY(-5px)');
                    $(this).css('box-shadow', '0 8px 20px rgba(0, 0, 0, 0.12)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                    $(this).css('box-shadow', '0 2px 8px rgba(0, 0, 0, 0.05)');
                }
            );
        });
    </script>
@endsection
