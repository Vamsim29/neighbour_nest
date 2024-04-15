<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxurious Calendar</title>
    <style>
        
        .month-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #333;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            color: #fff;
        }

        .month-header h2 {
            font-size: 24px;
            margin: 0;
        }

        .month-header h3 {
            font-size: 18px;
            margin: 0;
        }

        .month-header button {
            font-size: 18px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            outline: none;
            color: #ccc;
            transition: color 0.3s ease;
        }

        .month-header button:hover {
            color: #fff;
        }

        .week-days {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f8f8f8;
            border-bottom: 1px solid #ddd;
        }

        .week-days span {
            width: calc(100% / 7);
            text-align: center;
            font-weight: bold;
            color: #666;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, calc(95% / 7));
            gap: 5px;
            padding: 10px;
        }

        .day {
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 5px;
            text-align: center;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .current-day {
            background-color: #f5f5f5;
        }

        .current-day-today {
            background-color: #cceeff;
        }

        .day:hover {
            background-color: #f0f0f0;
        }

        #selected-date {
            text-align: center;
            padding: 10px;
            font-size: 16px;
            color: #666;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            background-color: #f8f8f8;
        }

        #select-month,
        #select-year,
        #go-to-date {
            margin-left: 10px;
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            border: none;
            outline: none;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            background-color: #333;
            color: #fff;
        }

        #select-month:hover,
        #select-year:hover,
        #go-to-date:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="calendar">
            <div class="month-header">
                <button id="prev-month">&lt;</button>
                <h2 id="month-name"></h2>
                <h3 id="year"></h3>
                <button id="next-month">&gt;</button>
                <select id="select-month"></select>
                <select id="select-year"></select>
                <button id="go-to-date">Go</button>
            </div>
            <div class="week-days">
                <span>Sun</span>
                <span>Mon</span>
                <span>Tue</span>
                <span>Wed</span>
                <span>Thu</span>
                <span>Fri</span>
                <span>Sat</span>
            </div>
            <div class="days" id="calendar-days"></div>
            <p id="selected-date"></p>
        </div>
    </div>

    <script>
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        const today = new Date();
        let selectedDate = today;
        const monthsContainer = document.getElementById("calendar-days");
        const monthNameEl = document.getElementById("month-name");
        const yearEl = document.getElementById("year");
        const prevMonthBtn = document.getElementById("prev-month");
        const nextMonthBtn = document.getElementById("next-month");
        const selectedDateEl = document.getElementById("selected-date");

        function generateCalendar(year, month) {
            // Get the first day of the month
            const firstDay = new Date(year, month, 1).getDay();
            // Get the number of days in the month
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Clear the previous calendar days
            monthsContainer.innerHTML = "";

            // Add leading blank days for the first week
            if (firstDay > 0) {
                for (let i = 1; i <= firstDay; i++) {
                    const blankDayElement = document.createElement("span");
                    blankDayElement.classList.add("day", "blank");
                    monthsContainer.appendChild(blankDayElement);
                }
            }

            // Add days to the calendar
            for (let i = 1; i <= daysInMonth; i++) {
                const dayElement = document.createElement("span");
                dayElement.classList.add("day");
                dayElement.textContent = i;

                // Highlight the current day
                if (i === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    dayElement.classList.add("current-day-today");
                }

                dayElement.addEventListener("click", () => {
                    selectedDate = new Date(year, month, i);
                    updateSelectedDate();
                });

                monthsContainer.appendChild(dayElement);
            }

            // Update month and year displays
            monthNameEl.textContent = monthNames[month];
            yearEl.textContent = year;

            updateSelectedDate();
        }

        // Function to generate year options
        function generateYearOptions() {
            const yearSelect = document.getElementById('select-year');
            const currentYear = new Date().getFullYear();
            for (let i = currentYear - 10; i <= currentYear + 10; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }
            yearSelect.value = selectedDate.getFullYear();
        }

        // Function to generate month options
        function generateMonthOptions() {
            const monthSelect = document.getElementById('select-month');
            for (let i = 0; i < 12; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = monthNames[i];
                monthSelect.appendChild(option);
            }
            monthSelect.value = selectedDate.getMonth();
        }

        // Generate initial year and month options
        generateYearOptions();
        generateMonthOptions();

        // Event listener for the "Go" button
        document.getElementById('go-to-date').addEventListener('click', () => {
            const selectedYear = +document.getElementById('select-year').value;
            const selectedMonth = +document.getElementById('select-month').value;
            selectedDate = new Date(selectedYear, selectedMonth, 1);
            generateCalendar(selectedYear, selectedMonth);
        });

        // Event listeners for month navigation buttons
        prevMonthBtn.addEventListener("click", () => {
            selectedDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() - 1, 1);
            generateCalendar(selectedDate.getFullYear(), selectedDate.getMonth());
        });

        nextMonthBtn.addEventListener("click", () => {
            selectedDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth() + 1, 1);
            generateCalendar(selectedDate.getFullYear(), selectedDate.getMonth());
        });

        // Update selected date information
        function updateSelectedDate() {
            selectedDateEl.textContent = `${monthNames[selectedDate.getMonth()]} ${selectedDate.getDate()}, ${selectedDate.getFullYear()} (${dayNames[selectedDate.getDay()]})`;
        }
        generateCalendar(today.getFullYear(), today.getMonth());

    </script>
    </div>
</body>
</html>
