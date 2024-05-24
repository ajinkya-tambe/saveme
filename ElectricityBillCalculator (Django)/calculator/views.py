from django.shortcuts import render
from .models import ElectricityBill

def calculate_bill(request):
    if request.method == 'POST':
        units_consumed = int(request.POST.get('units_consumed', 0))
        bill = ElectricityBill(units_consumed=units_consumed)
        total_bill = bill.calculate_bill()
        return render(request, 'calculator/result.html', {'total_bill': total_bill})

    return render(request, 'calculator/index.html')
