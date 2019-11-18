using System;
using Kniga_Kontaktov.Models;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using static Kniga_Kontaktov.Models.PageInfo;


namespace Kniga_Kontaktov.Controllers
{
    public class HomeController : Controller
    {
        KontaktContext db = new KontaktContext();

        public ActionResult Index(int page=1)
        {
            int pageSize = 3;
            IEnumerable<Kontakt> booksPerPages = db.Kontakts.OrderBy(x => x.Id).Skip((page - 1) * pageSize).Take(pageSize).ToList();
            PageInfo pageInfo = new PageInfo { PageNumber = page, PageSize = pageSize, TotalItems = db.Kontakts.Count() };
            IndexViewModel ivm = new IndexViewModel { PageInfo = pageInfo, Kontakts = kontaktsPerPages };
            var books = db.Kontakts;
            ViewBag.Kontakts = Kontakts;
            int hour = DateTime.Now.Hour;
            ViewData["Head"] = "PhoneBook";
            ViewBag.Greeting = hour < 12 ? "Good Morning" : "Good Afternoon";
            return View(ivm);
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }
    }
}