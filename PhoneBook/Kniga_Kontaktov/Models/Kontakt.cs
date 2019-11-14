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
}