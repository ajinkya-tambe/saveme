from django.db import models

class ElectricityBill(models.Model):
    units_consumed = models.PositiveIntegerField()

    def calculate_bill(self):
        if self.units_consumed <= 50:
            return 3.50 * self.units_consumed
        elif self.units_consumed <= 150:
            return 3.50 * 50 + 4.00 * (self.units_consumed - 50)
        elif self.units_consumed <= 250:
            return 3.50 * 50 + 4.00 * 100 + 5.20 * (self.units_consumed - 150)
        else:
            return 3.50 * 50 + 4.00 * 100 + 5.20 * 100 + 6.50 * (self.units_consumed - 250)

    class Meta:
        app_label = 'calculator'