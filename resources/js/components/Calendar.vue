<template>    
        <div class="grid grid-cols-2 bg-gray-300 place-content-center">                                    
            <div class="text-gray-700 text-left px-4 py-2 m-5">                
                <FormEvent @createCalendar="createCalendar"/>
            </div>            
            <div class="text-gray-700 text-left px-4 py-2 m-5">
                <div class="flex bg-white shadow-md rounded px-4 py-2 h-full border">
                    <table class="border border-collapse table-auto w-full whitespace-no-wrap bg-white table-stripe relative">
                        <thead>
                            <tr class="text-left">                                
                                <th class="border bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs" style="width: 50px;">
                                    Day
                                </th>
                                <th class="border bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                    Event Title
                                </th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <tr v-if="calendar_list.length === 0">
                                <td colspan="2" class="border border-dashed border-t border-gray-200 px-5 text-gray-300 text-center">Select a "FROM" date to display Calendar</td>
                            </tr>
                            <tr v-for="item in calendar_list" :key="item.day">                                                                
                                <td class="border border-dashed border-t border-gray-200 px-5">{{ String(item.day).padStart(2,'0') + " - " + dow_string[item.dow] }}</td>
                                <td class="border border-dashed border-t border-gray-200 px-5">{{ item.event }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <notificationGroup group="top">
                <div class="fixed inset-0 flex px-4 py-6 pointer-events-none p-6 items-start justify-end">
                    <div class="max-w-sm w-full">
                    <notification v-slot="{notifications}">
                        <div
                        class="flex max-w-sm w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-4"
                        v-for="notification in notifications"
                        :key="notification.id"
                        >
                        <div class="flex justify-center items-center w-12 bg-green-500">
                            <svg
                            class="h-6 w-6 fill-current text-white"
                            viewBox="0 0 40 40"
                            xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"
                            ></path>
                            </svg>
                        </div>

                        <div class="-mx-3 py-2 px-4">
                            <div class="mx-3">
                            <span class="text-green-500 font-semibold">{{notification.title}}</span>
                            <p class="text-gray-600 text-sm">{{notification.text}}</p>
                            </div>
                        </div>
                        </div>
                    </notification>
                    </div>
                </div>
            </notificationGroup>
        </div>        
</template>

<script>
import FormEvent from './EventsForm.vue'

export default {
    name: 'calendar',
    components: {
        FormEvent
    },
    data: function() {
        return {
            calendar_list: [],
            dow_string: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
        }
    },
    created() {
        
    },
    methods: {
        createCalendar: function(start_date) {       
            var obj = this;     
            var date = new Date(start_date);
            var getmonth = date.getMonth()+1;
            var getfullyear = date.getFullYear();

            axios.get('/calendar/event/list', {
                params: {
                    month: getmonth,
                    year: getfullyear
                }
            })
            .then(function (response) {
                obj.calendar_list = response.data;                     
            })
            .catch(error => {
                console.log(error)
                this.hasError = true;
            });
        }
    }

}

</script>

<style>
    
</style>