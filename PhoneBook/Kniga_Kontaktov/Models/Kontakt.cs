using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Kniga_Kontaktov.Models
{
    public class Kontakt
    {
        public int Id { get; set; }
        public string KontaktRoleId { get; set; }
        public string Name { get; set; }
        public string Surname { get; set; }
        public string Number { get; set; }
        public string Email { get; set; }
    }
    public class PageInfo
    {
        public int PageNumber { get; set; }
        public int PageSize { get; set; }
        public int TotalItems { get; set; }
        public int TotalPages
        {
            get { return (int)Math.Ceiling((decimal)TotalItems / PageSize); }
        }
    }
}