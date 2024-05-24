package com.bill.calcbill.controller;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.PostMapping;


@Controller
public class BillCalc {
    @RequestMapping("/")
    public String myPage(){
        return "index";
    }

    @PostMapping("/billCalculator")
    public String billCalculator(@RequestParam("unit") int unit, Model model) {
        double total = 0;

        if (unit > 0) {
            total += calculate(unit, new int[]{1, 50}, 3.50);
            total += calculate(unit, new int[]{51, 150}, 4);
            total += calculate(unit, new int[]{151, 250}, 5.20);
            total += calculate(unit, new int[]{251, Integer.MAX_VALUE}, 6.50);
        }

        model.addAttribute("total", total);
        return "index";
    }

    private double calculate(int unit, int[] range, double price) {
        int minUnit = Math.min(unit, range[1]); 
        int unitsToCalculate = minUnit - range[0] + 1;
        if (unitsToCalculate < 0) {
            unitsToCalculate = 0; 
        }
        double bill = unitsToCalculate * price; 
        return bill;
    }
    
}
